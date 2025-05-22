<?php
// src/Controller/UserChatController.php
namespace App\Controller;

use App\Repository\CourseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserChatController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/user/ask-question/{id}', name: 'user_ask_question')]
    public function askQuestion(Request $request, int $id, CourseRepository $courseRepository): Response
    {
        $course = $courseRepository->find($id);
        if (!$course) {
            throw $this->createNotFoundException('Cours non trouvé');
        }

        $question = $request->request->get('question');
        $answer = null;

        if ($question) {
            $messages = [
                ['role' => 'system', 'content' => "Tu es un assistant intelligent pour le cours : " . $course->getTitle()],
                ['role' => 'user', 'content' => $question],
            ];

            $response = $this->client->request('POST', 'http://localhost:11434/api/chat', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'tinyllama',
                    'messages' => $messages,
                    'stream' => false,
                ],
            ]);

            $data = $response->toArray(false);
            $answer = $data['message']['content'] ?? 'Réponse indisponible.';
        }

        return $this->render('user/ask_question.html.twig', [
            'course' => $course,
            'question' => $question,
            'answer' => $answer,
        ]);
    }

    // ✅ Nouvelle fonctionnalité : Génération de plan d’étude
    #[Route('/user/course-plan/{id}', name: 'user_course_plan')]
    public function generateCoursePlan(int $id, CourseRepository $courseRepository): Response
    {
        $course = $courseRepository->find($id);
        if (!$course) {
            throw $this->createNotFoundException('Cours non trouvé');
        }

        $messages = [
            ['role' => 'system', 'content' => "Tu es un assistant pédagogique."],
            ['role' => 'user', 'content' => "Génère une démarche sous forme de plan structuré ou mind map pour bien étudier le cours suivant : " . $course->getTitle()],
        ];

        $response = $this->client->request('POST', 'http://localhost:11434/api/chat', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'tinyllama',
                'messages' => $messages,
                'stream' => false,
            ],
        ]);

        $data = $response->toArray(false);
        $plan = $data['message']['content'] ?? 'Plan indisponible.';

        return $this->render('user/course_plan.html.twig', [
            'course' => $course,
            'plan' => $plan,
        ]);
    }
}

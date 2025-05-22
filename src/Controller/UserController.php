<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserCourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\UserCourse;


#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/home', name: 'user_homepage')]
    public function home(): Response
    {
        return $this->render('user/home.html.twig');
    }

    #[Route('/courses', name: 'user_courses')]
    public function courses(CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findAll();

        return $this->render('user/courses.html.twig', [
            'courses' => $courses,
        ]);
    }

    #[Route('/user/my-courses', name: 'my_courses')]
public function myCourses(UserCourseRepository $userCourseRepo): Response
{
    $user = $this->getUser();
    $userCourses = $userCourseRepo->findBy(['user' => $user]);

    return $this->render('user/progress.html.twig', [
        'userCourses' => $userCourses
    ]);
}


    #[Route('/user/start-course/{id}', name: 'user_start_course')]
public function startCourse(
    int $id,
    CourseRepository $courseRepo,
    UserCourseRepository $userCourseRepo,
    EntityManagerInterface $em
): Response {
    $user = $this->getUser();
    $course = $courseRepo->find($id);

    if (!$course) {
        throw $this->createNotFoundException('Cours non trouvé.');
    }

    $existing = $userCourseRepo->findOneBy(['user' => $user, 'course' => $course]);
    if (!$existing) {
        $userCourse = new UserCourse();
        $userCourse->setUser($user);
        $userCourse->setCourse($course);
        $userCourse->setStartedAt(new \DateTimeImmutable());
        $em->persist($userCourse);
        $em->flush();
    }

    return $this->redirectToRoute('my_courses');
}

#[Route('/user/progress', name: 'user_progress')]
public function progress(UserCourseRepository $userCourseRepo): Response
{
    $user = $this->getUser();
    $userCourses = $userCourseRepo->findBy(['user' => $user]);

    return $this->render('user/progress.html.twig', [
        'userCourses' => $userCourses
    ]);
}


}

<?php

namespace App\Controller;

use App\Repository\UserCourseRepository;
use App\Repository\UserRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/users', name: 'admin_users')]
public function users(UserRepository $userRepository): Response
{
    $users = $userRepository->findAll();

    return $this->render('admin/users.html.twig', [
        'users' => $users,
    ]);
}


    #[Route('/courses', name: 'admin_courses')]
public function manageCourses(CourseRepository $courseRepository): Response
{
    $courses = $courseRepository->findAll();

    return $this->render('admin/courses.html.twig', [
        'courses' => $courses,
    ]);
}

    #[Route('/statistics', name: 'admin_statistics')]
public function statistics(UserRepository $userRepo, UserCourseRepository $userCourseRepo): Response
{
    $users = $userRepo->findAll();
    $stats = [];

    foreach ($users as $user) {
        $courseCount = $userCourseRepo->count(['user' => $user]);
        $stats[] = [
            'user' => $user,
            'courseCount' => $courseCount,
        ];
    }

    return $this->render('admin/statistics.html.twig', [
        'stats' => $stats,
    ]);
}

    #[Route('/users/{id}', name: 'admin_user_detail')]
public function userDetail(int $id, UserRepository $userRepository): Response
{
    $user = $userRepository->find($id);

    if (!$user) {
        throw $this->createNotFoundException('Utilisateur non trouvé.');
    }

    return $this->render('admin/user_detail.html.twig', [
        'user' => $user,
    ]);
}

}

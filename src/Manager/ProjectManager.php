<?php

namespace App\Manager;

use App\Entity\Search;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function PHPUnit\Framework\throwException;

class ProjectManager
{
    private  $paginator;
    private $projectRepository;

    public function __construct(
        PaginatorInterface $paginator,
        ProjectRepository $projectRepository
    ) {
        $this->paginator = $paginator;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param Search  $search
     * @param Request $request
     * @return void
     */
    public function getFilteredProjects(Search $search, Request $request)
    {

        $projects = $this->projectRepository->findAllQuery($search);
        $projectPerPage = $this->paginator->paginate(
            $projects,
            $request->query->getInt('page', 1),
            3
        );

        return $projectPerPage;
    }

    /**
     * @param Project $project
     * @param UploadedFile $image
     * @return Project
     */
    public function handleImageUpload(Project $project, UploadedFile $image)
    {
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '-' . uniqid() . '.' . $image->guessExtension();
        try {
            $project->setFilname($newFilename);
            $project->setImage(file_get_contents($image->getPathname()));
            $image->move(
                '../public/images',
                $newFilename
            );
        } catch (FileException $e) {
            throw new \RuntimeException($e->getMessage);
        }

        return $project;
    }
}

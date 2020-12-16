<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiGenreController extends AbstractController
{
    /**
     * @Route("/api/genres", name="api_genres", methods={"GET"})
     */
    public function list(GenreRepository $repo, SerializerInterface $serializer)
    {
        $genres=$repo->findAll();
        $resultat=$serializer->serialize(
            $genres,
            'json',
            [
                'groups'=>['listGenreFull']
            ]
        );
        return new JsonResponse($resultat, 200, [], true);
    }

    /**
     * @Route("/api/genres/{id}", name="api_genres_show", methods={"GET"})
     */
    public function show(Genre $genre, SerializerInterface $serializer)
    {
        $resultat=$serializer->serialize(
            $genre,
            'json',
            [
                'groups'=>['listGenreSimple']
            ]
        );
        return new JsonResponse($resultat, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/genres/", name="api_genres_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer)
    {
        $data=$request->getContent();
        // $genre=new Genre();
        // $serializer->deserialize($data, Genre::class, 'json', ['object_to_populate'=>$genre]);
        $genre->deserialize($data, Genre::class, 'json'); // 03:40 vidéo
        $resultat=$serializer->serialize(
            $genre,
            'json',
            [
                'groups'=>['listGenreSimple']
            ]
        );
        return new JsonResponse($resultat, Response::HTTP_OK, [], true);
    }
}
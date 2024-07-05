<?php

namespace App\Controller;

use App\Entity\Cursos;
use App\Repository\CursosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WsLanbideController extends AbstractController
{

    private function convertToJson($object):JsonResponse
    {
        $encoders=[new XmlEncoder(),new JsonEncoder()];
        $normalizers=[new DateTimeNormalizer(),new ObjectNormalizer()];
        $serializers= new Serializer($normalizers,$encoders); $normalized=$serializers->normalize($object,null,array(DateTimeNormalizer::FORMAT_KEY=>"Y/m/d"));
        $JsonContent=$serializers->serialize($normalized,"json");
        return JsonResponse::fromJsonString($JsonContent,200);
    }

    #[Route('/ws/lanbide', name: 'app_ws_lanbide', methods: 'GET')]
    public function getAll(CursosRepository $cursosRepository): JsonResponse
    {
        //Primero obtenemos todos los coches de la base de datos
        $cursos = $cursosRepository->findAll();
        //Convertimos los coches a JSON
        return $this->convertToJson($cursos);
    }

    #[Route('/ws/lanbide/get/{id}', name: 'app_ws_get_lanbide', methods: 'GET')]
    public function getID(CursosRepository $cursosRepository, $id): JsonResponse
    {
        $cursos = $cursosRepository->find($id);
        return $this->convertToJson($cursos);
    }
    #[Route('/ws/lanbide/delete/{id}', name: 'app_ws_delete_lanbide', methods: 'DELETE')]
    public function deleteID(CursosRepository $cursosRepository, $id): JsonResponse
    {
        $cursos = $cursosRepository->find($id);
        $cursosRepository->remove($cursos, true);
        return $this->convertToJson($cursos);
    }
    #[Route('/ws/lanbide/add', name: 'app_ws_add_lanbide', methods: 'POST')]
    public function add(CursosRepository $cursosRepository, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        if(empty($data['nombre'])){
		throw new NotFoundHttpException('Faltan parámetros');
}
        $curso = new Cursos();
        $curso->setNombre($data['nombre']);
        $cursosRepository->add($curso, true);
        return new JsonResponse(['status','Curso creado'],JsonResponse::HTTP_CREATED);



    }





}

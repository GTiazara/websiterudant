<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController'
        ]);
    }

    /**
     * @Route("/listImages", name="listImages")
     */
    public function listImages(Request $request): Response
    {
        if($request->request->get('target_dir')){
            $target_dir=$request->request->get('target_dir');
            $server_link=$_SERVER['REQUEST_URI'];
            $directory = dirname(__FILE__);
            $path_parts=explode("\\",$directory);
            $public_dir="";
            foreach($path_parts as $e){
                if($e=="src"){
                    break;}
                $public_dir=$public_dir.$e."/";
            }
            $final_dir=$public_dir."public/".$target_dir;
            $finder = new Finder();
            // find all files in the current directory
            $finder->in($final_dir);
            $output3=[];

            foreach ($finder as $file) {
                $absoluteFilePath = $file->getRealPath();
                $query='getImage?'.http_build_query(["image_path"=>$absoluteFilePath]);
                $output3[]=$query;
            }
            

            return new JsonResponse($output3);
        }
        else{
            return new JsonResponse(["Error"=>"Something went wrong in listImages!"]);
        }
    }
    /**
     * @Route("/getImage", name="getImage")
     */
    public function getImage(Request $request):Response
    {
        
        if($request->query->get('image_path')){
            $image = $request->query->get('image_path');
            $file= readfile($image);
            // you can modify headers here, before returning
            $content_type='';
            if(strpos($image, ".jpeg")){
                $content_type='image/jpeg';
            }
            else if(strpos($image, ".mp4")){
                $content_type='video/mp4';
            }
            $headers = array(
                'Content-Type'     => $content_type,
                'Content-Disposition' => 'inline; filename="'.$image.'"');
            //$response = new BinaryFileResponse($file);
            return new Response($file, 200, $headers);


        }
        else{
            return new JsonResponse(["Error"=>"Something went wrong in getImage!"]);

        }
        
        
    }
    /**
     * @Route("/{chapter}", name="chapters")
     */
    public function chapters($chapter): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController','chapter'=>$chapter
        ]);
    }


    /**
     * @Route("/change-locale/{locale}",name="change_locale")
     */
    public function changeLocale($locale, Request $request){
        $request->getSession()->set('_locale',$locale);

        return $this->redirect($request->headers->get('referer'));
    }
    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        return $this->render('main/test.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}

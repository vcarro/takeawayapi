<?php
declare(strict_types=1);

/**
 * ApiController.php
 *
 * API Controller
 *
 * @category   Controller
 * @package    TakeawayAPI
 * @author     Vidal Carro
 * @copyright  2019 Vidal Carro
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */
 
namespace App\Controller;
 
use App\Entity\Restaurant;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use JMS\Serializer\SerializationContext;
use Swagger\Annotations as SWG;
 
/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends FOSRestController
{
    /**
     * @Rest\Post("/login_check", name="user_login_check")
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was logged in successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not logged in successfully"
     * )
     *
     * @SWG\Parameter(
     *     name="username",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="password",
     *     in="body",
     *     type="string",
     *     description="The password",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="User")
     */
    public function getLoginCheckAction() {}

    /**
     * @Rest\Get("/v1/restaurants.{_format}", name="restaurants_list_all", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get all restaurants sorting from opening state."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to return all restaurants."
     * )
     * 
     * @SWG\Parameter(
     *     name="version",
     *     in="query",
     *     description="client number version",
     *     type="string"
     * )
     *
     * @SWG\Tag(name="Restaurants")
     */
    public function getAllRestaurantsAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $restaurants = [];
        $message = "";
 
        try {
            $code = 200;
            $error = false;
 
            $version = $request->query->get("version", '1.0');
            $restaurants = $em->getRepository("App:Restaurant")->findAll();
   
            if (is_null($restaurants)) {
                $restaurants = [];
            }
 
        } catch (\Exception $e) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get all Restaurants - Error: {$e->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $restaurants : $message,
        ];
 
        return new Response($serializer->serialize($response, "json", SerializationContext::create()->setVersion($version)));
    }

    /**
     * @Rest\Get("/v1/restaurants/sort.{_format}", name="restaurants_sort_by_field", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get all restaurants sorting from field selected."
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="Type of field filter is incorrect."
     * )
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to return the sorting restaurants."
     * )
     *
     * @SWG\Parameter(
     *     name="field",
     *     in="query",
     *     description="The field to sort the restaurants",
     *     type="string",
     *     enum={"best match", "newest", "rating average", "popularity", "average product price", "delivery costs",  "minimum order amount costs"}
     * )
     * @SWG\Parameter(
     *     name="version",
     *     in="query",
     *     description="client number version",
     *     type="string",
     * )
     * 
     * @SWG\Tag(name="Restaurants")
     */
    public function getRestaurantsSortedByFieldAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $restaurants = [];
        $message = "";

        try {
            $code = 200;
            $error = false;

            $field = $request->query->get("field", '');
            $version = $request->query->get("version", '1.0');
            $restaurants = $em->getRepository("App:Restaurant")->findAllSortedByField($field);
	    
	    if (is_null($restaurants)) {
                $restaurants = [];
            }
        } catch (TypeError $te) {
            $code = 400;
            $error = true;
            $message = "Incorrect type field filter to sort Restaurants - Error: {$te->getMessage()}";
        } catch (\Exception $e) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get all Restaurants sorted by field - Error: {$e->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $restaurants : $message,
        ];

        return new Response($serializer->serialize($response, "json", SerializationContext::create()->setVersion($version)));
    }

    /**
     * @Rest\Get("/v1/restaurants/search.{_format}", name="restaurants_search_by_name", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get all restaurants that match search by name."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to return the restaurants by name."
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="The name to search for the restaurant",
     *     type="string",
     * )
     * @SWG\Parameter(
     *     name="version",
     *     in="query",
     *     description="client number version",
     *     type="string",
     * )
     * 
     * @SWG\Tag(name="Restaurants")
     */
    public function getRestaurantsSearchByNameAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $restaurants = [];
        $message = "";

        try {
            $code = 200;
            $error = false;

            $name = $request->query->get("name", null);
            $version = $request->query->get("version", '1.0');
            if (empty($name)) {
                throw new \Exception("Parameter name it is empty");
            }
            $dqlQuery = $em->createQuery("SELECT r FROM App:Restaurant r WHERE r.name LIKE '%$name%'");
            $restaurants = $dqlQuery->getResult();

            if (is_null($restaurants)) {
                $restaurants = [];
            }

        } catch (\Exception $e) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to search restaurants by name - Error: {$e->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $restaurants : $message,
        ];

        return new Response($serializer->serialize($response, "json", SerializationContext::create()->setVersion($version)));
    }

}

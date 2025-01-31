<?php

namespace App\Services\OpenFoodFacts;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OpenFoodFactsService implements OpenFoodFactsServiceInterface
{
    public function getByBarcode($barcode)
    {
        $base_url = 'https://world.openfoodfacts.org/api/';

        $url = $base_url . sprintf("v3/product/%s?cc=id&fields=product_name,brands,nutriments,image_url,categories,serving_quantity,serving_quantity_unit,nutrition_data_per", $barcode);

        Log::info($url);

        $response = Http::get($url);

        Log::info($response->json());

        if ($response->json()['status'] == 'failure') {
            throw new NotFoundHttpException();
        }

        return $response->json();
    }

    public function search($keyword)
    {
        $base_url = 'https://world.openfoodfacts.org/cgi/';

        $url = $base_url . sprintf("search.pl?search_terms=%s&search_simple=1&json=1&fields=product_name,code", $keyword);

        Log::info($url);

        $response = Http::get($url);

        Log::info($response->json());

        if ($response->json()['count'] == 0) {
            throw new NotFoundHttpException();
        }

        return $response->json();

        // try {

        // } catch (ClientException $ec) {
        //     $errorResponse = $ec->getResponse();
        //     $statusCode = $errorResponse->getStatusCode();
        //     $errorMessage = $errorResponse->getBody()->getContents();
        //     Log::info("Search from Open Food Facts Error => " . Carbon::now('Asia/Jakarta')->toDateTimeString());
        //     Log::error($errorMessage);
        // } catch (ServerException $sc) {
        //     $errorResponse = $sc->getResponse();
        //     $statusCode = $errorResponse->getStatusCode();
        //     $errorMessage = $sc->getMessage();
        //     Log::info("Search from Open Food Facts Error => " . Carbon::now('Asia/Jakarta')->toDateTimeString());
        //     Log::error($errorMessage);
        // } catch (Exception $e) {
        //     $errorMessage = $e->getMessage();
        //     Log::info("Search from Open Food Facts Error=> " . Carbon::now('Asia/Jakarta')->toDateTimeString());
        //     Log::error($errorMessage);
        // }
    }
}

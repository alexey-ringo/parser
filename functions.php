<?php

function getHtml(string $url, \GuzzleHttp\Client $client): string
{
    $response = $client->get($url);
    return $response->getBody()->getContents();
}

function getPagesCount(\DiDom\Document $document): int
{
    $pagination = $document->find('.pagination-list a.pagination-link');
    if (count($pagination) > 1) {
        return $pagination[count($pagination) - 2]->text();
    } else {
        return 1;
    }
}

function getProducts(\DiDom\Document $document, \GuzzleHttp\Client $client)
{
    $products = $document->find('article.card');
    foreach ($products as $product) {
        $title = $product->first('h4.card-title a')?->text();
        $link = $product->first('h4.card-title a')?->attr('href');

        echo "$title | $link\n";
    }
}

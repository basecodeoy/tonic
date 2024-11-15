<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Transformers;

use BaseCodeOy\Tonic\Contracts\ResourceInterface;
use BaseCodeOy\Tonic\Data\DocumentData;
use BaseCodeOy\Tonic\Data\RequestObjectData;
use BaseCodeOy\Tonic\Data\ResourceObjectData;
use BaseCodeOy\Tonic\Normalizers\ModelNormalizer;
use BaseCodeOy\Tonic\Normalizers\ResourceNormalizer;
use BaseCodeOy\Tonic\QueryBuilders\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

final readonly class Transformer
{
    private function __construct(
        private RequestObjectData $requestObject,
    ) {}

    public static function create(RequestObjectData $requestObject): self
    {
        return new self($requestObject);
    }

    public function item(Model|ResourceInterface $item): DocumentData
    {
        if ($item instanceof Model) {
            return DocumentData::from([
                'data' => ModelNormalizer::normalize($item)->toArray(),
            ]);
        }

        return DocumentData::from([
            'data' => ResourceNormalizer::normalize($item)->toArray(),
        ]);
    }

    public function collection(Collection $collection): DocumentData
    {
        return DocumentData::from([
            'data' => $collection->map(function (Model|ResourceInterface $item): ResourceObjectData {
                if ($item instanceof Model) {
                    return ModelNormalizer::normalize($item);
                }

                return ResourceNormalizer::normalize($item);
            })->toArray(),
        ]);
    }

    public function cursorPaginate(Builder|QueryBuilder $query): DocumentData
    {
        /** @var CursorPaginator $paginator */
        $paginator = $query->cursorPaginate(
            (int) $this->requestObject->getParam('page.size', '100'),
            ['*'],
            'page[cursor]',
            (string) $this->requestObject->getParam('page.cursor'),
        );

        $document = self::collection($paginator->getCollection())->toArray();

        if ($paginator->hasPages()) {
            $document['meta'] = [
                'page' => [
                    'cursor' => [
                        'self' => $paginator->cursor()?->encode(),
                        'prev' => $paginator->previousCursor()?->encode(),
                        'next' => $paginator->nextCursor()?->encode(),
                    ],
                ],
            ];
        }

        return DocumentData::from($document);
    }

    public function paginate(Builder|QueryBuilder $query): DocumentData
    {
        /** @var LengthAwarePaginator $paginator */
        $paginator = $query->paginate(
            (int) $this->requestObject->getParam('page.size', '100'),
            ['*'],
            'page[number]',
            (int) $this->requestObject->getParam('page.number'),
        );

        $document = self::collection($paginator->getCollection())->toArray();

        if ($paginator->hasPages()) {
            $document['meta'] = [
                'page' => [
                    'number' => [
                        'self' => $paginator->currentPage(),
                        'prev' => $paginator->onFirstPage() ? null : $paginator->currentPage() - 1,
                        'next' => $paginator->hasMorePages() ? $paginator->currentPage() + 1 : null,
                    ],
                ],
            ];
        }

        return DocumentData::from($document);
    }

    public function simplePaginate(Builder|QueryBuilder $query): DocumentData
    {
        /** @var Paginator $paginator */
        $paginator = $query->simplePaginate(
            (int) $this->requestObject->getParam('page.size', '100'),
            ['*'],
            'page[number]',
            (int) $this->requestObject->getParam('page.number'),
        );

        $document = self::collection($paginator->getCollection())->toArray();

        if ($paginator->hasPages()) {
            $document['meta'] = [
                'page' => [
                    'number' => [
                        'self' => $paginator->currentPage(),
                        'prev' => $paginator->onFirstPage() ? null : $paginator->currentPage() - 1,
                        'next' => $paginator->hasMorePages() ? $paginator->currentPage() + 1 : null,
                    ],
                ],
            ];
        }

        return DocumentData::from($document);
    }
}

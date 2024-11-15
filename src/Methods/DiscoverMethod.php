<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Tonic\Methods;

// use Ergebnis\Json\Json;
// use Ergebnis\Json\Pointer\JsonPointer;
// use Ergebnis\Json\SchemaValidator\SchemaValidator;
use BaseCodeOy\Tonic\Contracts\MethodInterface;
use BaseCodeOy\Tonic\Contracts\UnwrappedResponseInterface;
use BaseCodeOy\Tonic\Facades\Server as Facade;
use BaseCodeOy\Tonic\OpenRPC\Values\ContentDescriptorValue;
// use BaseCodeOy\Tonic\Exceptions\ServerErrorException;
use BaseCodeOy\Tonic\OpenRPC\Values\DocumentValue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use function BaseCodeOy\Tonic\arr_filter_recursive;

/**
 * @see https://playground.open-rpc.org/
 * @see https://raw.githubusercontent.com/open-rpc/meta-schema/master/schema.json
 * @see https://spec.open-rpc.org/#service-discovery-method
 */
final class DiscoverMethod extends AbstractMethod implements UnwrappedResponseInterface
{
    #[\Override()]
    public function getName(): string
    {
        return 'rpc.discover';
    }

    #[\Override()]
    public function getSummary(): string
    {
        return 'Returns an OpenRPC schema as a description of this service';
    }

    #[\Override()]
    public function getResult(): ContentDescriptorValue
    {
        return ContentDescriptorValue::from([
            'name' => 'OpenRPC Schema',
            'schema' => [
                '$ref' => 'https://raw.githubusercontent.com/open-rpc/meta-schema/master/schema.json',
            ],
        ]);
    }

    public function handle(): array
    {
        $errors = $this->buildErrors();

        $methods = [];

        /** @var MethodInterface $serverMethod */
        foreach (Facade::getMethodRepository()->all() as $serverMethod) {
            $methods[] = [
                'name' => $serverMethod->getName(),
                'summary' => $serverMethod->getSummary(),
                'params' => $serverMethod->getParams(),
                'result' => $serverMethod->getResult(),
                'errors' => [
                    ...$errors,
                    ...$serverMethod->getErrors(),
                ],
            ];
        }

        $document = arr_filter_recursive([
            'openrpc' => '1.3.2',
            'info' => [
                'title' => Facade::getName(),
                'version' => Facade::getVersion(),
                'license' => ['name' => 'Proprietary'],
            ],
            'servers' => [
                [
                    'name' => App::environment(),
                    'url' => URL::to(Facade::getRoutePath()),
                ],
            ],
            'methods' => $methods,
            'components' => [
                'contentDescriptors' => collect(Facade::getContentDescriptors())->keyBy('name'),
                'schemas' => collect(Facade::getSchemas())->keyBy('name'),
                'errors' => collect($errors)->keyBy('message'),
            ],
        ]);

        // FIXME: the JSON Schema 'enum' keyword blows up the validator
        // $this->validateSchema(\json_encode($document, \JSON_THROW_ON_ERROR));

        return DocumentValue::from($document)->toArray();
    }

    private function buildErrors(): array
    {
        return [
            ['code' => -32_603, 'message' => 'Internal error'],
            ['code' => -32_602, 'message' => 'Invalid fields'],
            ['code' => -32_602, 'message' => 'Invalid filters'],
            ['code' => -32_602, 'message' => 'Invalid params'],
            ['code' => -32_602, 'message' => 'Invalid relationships'],
            ['code' => -32_600, 'message' => 'Invalid Request'],
            ['code' => -32_602, 'message' => 'Invalid sorts'],
            ['code' => -32_601, 'message' => 'Method not found'],
            ['code' => -32_700, 'message' => 'Parse error'],
            ['code' => -32_000, 'message' => 'Server error'],
            ['code' => -32_099, 'message' => 'Server not found'],
        ];
    }

    // private function validateSchema(string $document): void
    // {
    //     $schema = \file_get_contents(__DIR__.'/../../../resources/RPC/schema.json');

    //     if ($schema === false) {
    //         throw ServerErrorException::create([
    //             [
    //                 'status' => '418',
    //                 'title' => 'OpenRPC Schema Not Found',
    //                 'detail' => 'The OpenRPC schema could not be loaded.',
    //             ],
    //         ]);
    //     }

    //     $result = (new SchemaValidator())->validate(
    //         Json::fromString($document),
    //         Json::fromString($schema),
    //         JsonPointer::document(),
    //     );

    //     if ($result->isValid()) {
    //         return;
    //     }

    //     /** @var array<\Ergebnis\Json\SchemaValidator\ValidationError> $errors */
    //     $errors = $result->errors();
    //     $errorsTopLevel = $errors[0]->jsonPointer()->toReferenceTokens()[0];

    //     // Ignore the top-level openrpc error
    //     if (\count($errors) === 1 && $errorsTopLevel->toString() === 'openrpc') {
    //         return;
    //     }

    //     throw ServerErrorException::create([
    //         [
    //             'status' => '418',
    //             'title' => 'OpenRPC Schema Validation Failed',
    //             'detail' => 'The OpenRPC schema has failed validation.',
    //             'meta' => [
    //                 'errors' => $errors,
    //             ],
    //         ],
    //     ]);
    // }
}

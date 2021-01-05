<?php

namespace Hlis\Testing;

use Lucinda\URL\Response;
use Lucinda\UnitTest\Result;

require_once("hlis/unit_testing/validators/RobotsValidator.php");

class CasinosListsRobotsValidator extends RobotsValidator
{
    /**
     * Checks if response is correctly formatted
     *
     * @param Response $response
     * @return Result
     */
    protected function validate(Response $response): Result
    {
        $body = str_replace(array(" ", "\n", "\r"), "", $response->getBody());
        $test = "User-agent:*Disallow:/";
        if (ENVIRONMENT === "live") {
            $test = "User-agent:*Disallow:/visit/*";
        }

        return new Result($body == $test, $body == $test ? "" : "Invalid file body: '" . $body . "'");
    }

}
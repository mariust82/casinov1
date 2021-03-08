<?php
require_once("application/models/dao/Casinos.php");
require_once("application/models/dao/BestCasinoLabel.php");
require_once("application/models/UserOperationFailedException.php");
require_once 'application/models/CasinoScore.php';

/*
* Rates a casino.
*
* @requestMethod POST
* @responseFormat JSON
* @source
* @pathParameter name string Name of casino
* @requestParameter name Name of casino to be rated.
* @requestParameter value integer Value of rating (1-10)
*/
class CasinoRateController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $casinoID = $this->request->attributes('validation_results')->get('name');
        $object = new Casinos();
        if ($object->isCountryAccepted($casinoID, $this->request->attributes("country")->id)) {
            $success = $object->rate(
                $this->request->attributes('validation_results')->get('name'),
                $this->request->attributes("ip"),
                $this->request->attributes('validation_results')->get('value')
            );
            $this->response->attributes("success", $success);
            $casino_score = new CasinoScore();
            $votes = $object->getUserVotes($casinoID);
            $this->response->attributes("total_votes",$object->getAllVotes($casinoID));
            $this->response->attributes("total_score",ceil($object->getCasinoScore($casinoID)));
            $this->response->attributes("votes",$casino_score->setVotesByType($votes));

            if ($success) {
                $object = new BestCasinoLabel();
                $object->checkRatedCasino($casinoID);
            }

        } else { // if country is not accepted by casino, here, the exception is throed.
            throw new UserOperationFailedException("Your country is not supported!");
        }
    }
}

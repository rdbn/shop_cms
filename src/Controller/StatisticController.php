<?php

namespace App\Controller;

use App\Dto\StatisticFilterDto;
use App\Repository\ProductRepository;
use App\Repository\StatisticRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Response;

class StatisticController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function statistic(): Response
    {
        $statisticFilterDto = new StatisticFilterDto();
        $statisticFilterDto->date = $this->request->query->get("date", $statisticFilterDto->getDateToString());
        $statisticFilterDto->groupBy = $this->request->query->get("group_by", StatisticFilterDto::GROUP_BY["date"]);
        $statisticFilterDto->hourFrom = $this->request->query->get("hour_from");
        $statisticFilterDto->hourTo = $this->request->query->get("hour_to");
        $statisticFilterDto->product = $this->request->query->get("product");
        $statisticFilterDto->isEndOrder = $this->request->query->get("is_end_order");
        $statisticFilterDto->orderId = $this->request->query->get("order_id");
        $statisticFilterDto->page = $this->request->query->getInt("page", $statisticFilterDto->page);
        $statisticFilterDto->limit = $this->request->query->getInt("limit", $statisticFilterDto->limit);

//        try {
            $statistics = (new StatisticRepository())
                ->findStatisticByFilter($statisticFilterDto);
//        } catch (DBALException $e) {
//            $statistics = [];
//        }

        return $this->renderTemplate("statistic/statistic", [
            "statisticFilterDto" => $statisticFilterDto,
            "statistics" => $statistics,
            "requestQuery" => $this->request->query->all(),
        ]);
    }

    /**
     * @return Response
     */
    public function searchProduct(): Response
    {
        try {
            $products = (new ProductRepository())
                ->findProductByLikeName($this->request->query->get("query", ""));
        } catch (DBALException $e) {
            $products = [];
        }
        return $this->jsonResponse($products);
    }
}
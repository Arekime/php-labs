<?php

class ReqviewController extends PageController
{
    private function getPizzaOptions(): array
    {
        return [
            '1' => 'Pepperoni',
            '2' => 'Margherita',
            '3' => 'Hawaiian',
            '4' => 'Four Cheese',
            '5' => 'Veggie',
        ];
    }

    public function action_showrequest(): void
    {
        $getParams = $this->request->allGet();
        $postParams = $this->request->allPost();

        unset($getParams['route']);

        $selectedPizzas = [];
        if (!empty($postParams['option'])) {
            $options = $postParams['option'];
            $options = is_array($options) ? $options : [$options];
            $pizzaMap = $this->getPizzaOptions();
            
            foreach ($options as $optionId) {
                if (isset($pizzaMap[$optionId])) {
                    $selectedPizzas[] = $pizzaMap[$optionId];
                }
            }
        }

        $this->render('reqview/showrequest', [
            'getParams' => $getParams,
            'postParams' => $postParams,
            'method' => $this->request->method(),
            'selectedPizzas' => $selectedPizzas,
            'pizzaOptions' => $this->getPizzaOptions(),
        ], 'Перегляд параметрів запиту');
    }
}

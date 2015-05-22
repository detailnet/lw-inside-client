<?php

namespace LwiTest\Client\Response;

use Lwi\Client\Response\AssetList;

class AssetListTest extends ResponseTestCase
{
    public function testResponseCanBeCreatedFromGuzzleCommand()
    {
        $response = AssetList::fromCommand(
            $this->getCommand(array('results' => array()))
        );

        $this->assertInstanceOf('Lwi\Client\Response\AssetList', $response);
    }

    public function testItemsCanBeGet()
    {
        $id = 'some-id';
        $items = array(array('id' => $id));
        $result = array(
            'assets' => $items,
            'page_count' => 1,
            'page_size' => 10,
            'total_items' => 20,
        );

        $response = $this->getResponse($result);

        $plainItems = $response->getItems(true);

        $this->assertTrue(is_array($plainItems));
        $this->assertEquals($items, $plainItems);

        $responseItems = $response->getItems();

        /** @var \Lwi\Client\Response\Asset $responseItem */
        $responseItem = $responseItems[0];

        $this->assertTrue(is_array($responseItems));
        $this->assertCount(1, $responseItems);
        $this->assertInstanceOf('Lwi\Client\Response\Asset', $responseItem);
        $this->assertEquals($id, $responseItem->getId());
        $this->assertEquals($result['page_count'], $response->getPageCount());
        $this->assertEquals($result['page_size'], $response->getPageSize());
        $this->assertEquals(count($responseItems), $response->getItemCount());
        $this->assertEquals($result['total_items'], $response->getTotalItemCount());

        $emptyResponse = $this->getResponse();

        $this->setExpectedException('Lwi\Client\Exception\RuntimeException');
        $emptyResponse->getPageCount();

        /** @todo Handle expected exceptions for other methods... */
    }

    /**
     * @param array $data
     * @param string $class
     * @return AssetList
     */
    protected function getResponse(array $data = array(), $class = null)
    {
        if ($class === null) {
            $class = 'Lwi\Client\Response\AssetList';
        }

        return parent::getResponse($data, $class);
    }
}

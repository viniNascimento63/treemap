<?php

use PHPUnit\Framework\TestCase;
use Demander\Page;
use Rain\Tpl;

class PageTest extends TestCase
{
    private $page;

    protected function setUp(): void
    {
        // Mock do Tpl para não gerar dependências externas
        $tplMock = $this->getMockBuilder(Tpl::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        // Define que o método 'draw' deve ser chamado e deve retornar uma string
        $tplMock->expects($this->once())
                ->method('draw')
                ->with($this->equalTo('template_name'), $this->equalTo(false))
                ->willReturn('rendered_template');

        // Sobrescreve a propriedade 'tpl' da classe Page para usar o mock
        $this->page = $this->getMockBuilder(Page::class)
                           ->setConstructorArgs([[], 'views/'])
                           ->onlyMethods(['setData'])
                           ->getMock();

        // Sobrescreve o objeto Tpl dentro da classe Page
        $reflection = new \ReflectionClass($this->page);
        $tplProperty = $reflection->getProperty('tpl');
        $tplProperty->setAccessible(true);
        $tplProperty->setValue($this->page, $tplMock);
    }

    public function testSetTemplate()
    {
        $result = $this->page->setTemplate('template_name', ['key' => 'value']);
        
        // Verifica se o retorno do método está correto
        $this->assertEquals('rendered_template', $result);
    }
}

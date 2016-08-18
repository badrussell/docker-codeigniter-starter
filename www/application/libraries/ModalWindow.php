<?php

/**
 * Gera o código HTML necessário para a exibição de uma janela modal utilizando bootstrap
 * Essa biblioteca foi criada para permitir a reutilização de modais
 * Ao invés da div modal ficar fixa, ela é gerada em uma requisição
 * Dessa forma, é possível excluir a div modal anterior na chamada javascript
 * Toda funcionalidade javascript precisa ser implementada a parte, gera somente HTML
 */
class ModalWindow
{

    const MODAL_SIZE_SMALL = 'modal-sm';
    const MODAL_SIZE_LARGE = 'modal-lg';

    private $modalSize = 'modal-lg';
    private $modalId = 'modal';
    private $contentViewName;
    private $contentViewData;
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    /**
     *
     * @param type $modalViewName
     * @param type $customParams
     * @return type
     */
    public function createMarkup($modalViewName = 'modal', $customParams = null)
    {
        $aParams = $customParams;

        if ($customParams === null) {
            $content = $this->ci->load->view($this->contentViewName, $this->contentViewData, true);

            $aParams = array(
                'idDivModal' => $this->modalId,
                'sizeDivModal' => $this->modalSize,
                'modalContent' => $content
            );
        }

        return $this->ci->load->view($modalViewName, $aParams, true);
    }

    public function getModalId()
    {
        return $this->modalId;
    }

    public function setModalId($modalId)
    {
        $this->modalId = $modalId;
    }

    public function getContentViewName()
    {
        return $this->contentViewName;
    }

    public function getContentViewData()
    {
        return $this->contentViewData;
    }

    public function setContentViewName($contentViewName)
    {
        $this->contentViewName = $contentViewName;
    }

    public function setContentViewData($contentViewData)
    {
        $this->contentViewData = $contentViewData;
    }

    public function getModalContent()
    {
        return $this->modalContent;
    }

    public function getModalSize()
    {
        return $this->modalSize;
    }

    public function setModalSize($modalSize)
    {
        $this->modalSize = $modalSize;
    }

}

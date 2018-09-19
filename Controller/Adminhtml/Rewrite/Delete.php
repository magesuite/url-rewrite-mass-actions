<?php

namespace MageSuite\UrlRewriteMassActions\Controller\Adminhtml\Rewrite;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\UrlRewrite\Model\UrlPersistInterface
     */
    protected $urlPersistance;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\UrlRewrite\Model\UrlPersistInterface $urlPersistance
    )
    {
        parent::__construct($context);

        $this->urlPersistance = $urlPersistance;
    }

    public function execute()
    {
        $request = $this->getRequest();

        $urlRewriteIds = $request->getParam('url_rewrite_ids', []);

        if(!is_array($urlRewriteIds) or empty($urlRewriteIds)) {
            $this->messageManager->addError(__('No url rewrite ids were passed'));
            
            return $this->_redirect($this->_redirect->getRefererUrl());
        }

        $this->urlPersistance->deleteByData(['url_rewrite_id' => $urlRewriteIds]);

        $this->messageManager->addSuccess(__('Url rewrites were successfully deleted'));

        return $this->_redirect($this->_redirect->getRefererUrl());
    }
}
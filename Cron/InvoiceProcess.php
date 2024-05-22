<?php

declare(strict_types=1);

namespace Lotsofpixels\AutoInvoicer\Cron;

use Psr\Log\LoggerInterface;
use Lotsofpixels\AutoInvoicer\Api\InvoiceProcessInterfaceFactory;
use Lotsofpixels\AutoInvoicer\Helper\Data as HelperData;

class InvoiceProcess
{
    /**
     * @var HelperData
     */
    private $helperData;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var InvoiceProcessInterfaceFactory
     */
    private $invoiceProcessFactory;

    /**
     * @param HelperData $helperData
     * @param LoggerInterface $logger
     * @param InvoiceProcessInterfaceFactory $invoiceProcessFactory
     */
    public function __construct(
        HelperData $helperData,
        LoggerInterface $logger,
        InvoiceProcessInterfaceFactory $invoiceProcessFactory
    ) {
        $this->helperData = $helperData;
        $this->logger = $logger;
        $this->invoiceProcessFactory = $invoiceProcessFactory;
    }

    /**
     * Process completed orders with no invoice, if cron is enabled
     */
    public function execute()
    {
        if (!$this->helperData->isCronEnabled()) {
            return;
        }

        $this->logger->info('Starting auto invoice procedure.');
        $invoiceProcess = $this->invoiceProcessFactory->create();
        $items = $invoiceProcess->getItemsToProcess();

        foreach ($items as $item) {
            try {

                $order = $item->getOrder();
                $this->logger->info(sprintf(
                    'Invoicing order #%s',
                    $order->getIncrementId()
                ));
                $invoiceProcess->invoice($item);

            } catch (\Exception $ex) {
                $this->logger->critical($ex->getMessage());
            }
        }

        $this->logger->info('Auto invoice procedure completed.');
    }
}
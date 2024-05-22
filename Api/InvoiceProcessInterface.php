<?php

declare(strict_types=1);

namespace Lotsofpixels\AutoInvoicer\Api;

/**
 * @api
 */
interface InvoiceProcessInterface
{
    /**
     * Returns a list of items to process. Every item consists of an order, and a destination status.
     *
     * @returns \Lotsofpixels\AutoInvoicer\Api\Data\InvoiceProcessItemInterface
     */
    public function getItemsToProcess();

    /**
     * Invoice order
     *
     * @param \Lotsofpixels\AutoInvoicer\Api\Data\InvoiceProcessItemInterface $item
     */
    public function invoice(\Lotsofpixels\AutoInvoicer\Api\Data\InvoiceProcessItemInterface $item);
}
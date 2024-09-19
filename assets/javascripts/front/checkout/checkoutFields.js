/* globals wc_pagarme_checkout */
/* jshint esversion: 6 */
const pagarmeCustomerFields = {
    billingDocumentId: 'billing_document',
    shippingDocumentId: 'shipping_document',
    documentMasks: [
        '000.000.000-00999',
        '00.000.000/0000-00'
    ],
    documentMaskOptions: {
        onKeyPress: function (document, e, field, options) {
            const masks = pagarmeCustomerFields.documentMasks,
                mask = document.length > 14 ? masks[1] : masks[0];
            field.mask(mask, options);
        }
    },

    applyDocumentMask() {
        jQuery('#' + this.billingDocumentId).mask(this.documentMasks[0], this.documentMaskOptions);
        jQuery('#' + this.shippingDocumentId).mask(this.documentMasks[0], this.documentMaskOptions);
    },

    addEventListener() {
        jQuery(document.body).on('checkout_error', function () {
            const documentFieldIds = [
                    pagarmeCustomerFields.billingDocumentId,
                    pagarmeCustomerFields.shippingDocumentId
                ];
            jQuery.each(documentFieldIds, function () {
                const documentField = jQuery('#' + this + '_field');
                if (jQuery('.woocommerce-error li[data-pagarme-error="' + this + '"]').length) {
                    documentField.addClass('woocommerce-invalid');
                } else {
                    documentField.removeClass('woocommerce-invalid');
                }
            });
        });
    },

    start: function () {
        this.applyDocumentMask();
        this.addEventListener();
    }
};

pagarmeCustomerFields.start();

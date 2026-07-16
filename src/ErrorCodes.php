<?php

namespace Facturapi;

// Documented API root error.code constants. External PAC and SAT codes belong
// in errors[].code and are intentionally not included in this catalog.

final class CommonErrorCode
{
    public const CONFLICT = 'conflict';
    public const FORBIDDEN = 'forbidden';
    public const INTERNAL_ERROR = 'internal_error';
    public const NOT_FOUND = 'not_found';
    public const UNAUTHORIZED = 'unauthorized';
}

final class AuthErrorCode
{
    public const API_KEY_INVALID = 'api_key_invalid';
    public const API_KEY_NOT_ALLOWED = 'api_key_not_allowed';
    public const FEATURE_NOT_AVAILABLE = 'feature_not_available';
    public const LIVE_API_KEY_REQUIRED = 'live_api_key_required';
    public const MCP_PERMISSION_DENIED = 'mcp_permission_denied';
    public const MISSING_CREDENTIALS = 'missing_credentials';
    public const ORGANIZATION_INCOMPLETE = 'organization_incomplete';
    public const SUBSCRIPTION_REQUIRED = 'subscription_required';
    public const SUBSCRIPTION_LIVE_ACCESS_REQUIRED = 'subscription_live_access_required';
    public const USER_KEY_INVALID = 'user_key_invalid';
    public const USER_SUSPENDED = 'user_suspended';
}

final class RequestErrorCode
{
    public const IDEMPOTENCY_KEY_IN_USE = 'idempotency_key_in_use';
    public const RATE_LIMIT_EXCEEDED = 'rate_limit_exceeded';
    public const DATE_RANGE_TOO_LARGE = 'date_range_too_large';
    public const IMAGE_FILE_REQUIRED = 'image_file_required';
    public const INVALID_COUNTRY_CODE = 'invalid_country_code';
    public const INVALID_DATE = 'invalid_date';
    public const INVALID_DATE_RANGE = 'invalid_date_range';
    public const INVALID_IMAGE_FILE = 'invalid_image_file';
    public const INVALID_JSON = 'invalid_json';
    public const INVALID_REQUEST = 'invalid_request';
    public const INVALID_MULTIPART_FORM_DATA = 'invalid_multipart_form_data';
    public const INVALID_STATE_CODE = 'invalid_state_code';
    public const INVALID_TIMEZONE = 'invalid_timezone';
    public const MULTIPART_LIMIT_EXCEEDED = 'multipart_limit_exceeded';
    public const PAGE_TOO_LARGE = 'page_too_large';
    public const PAYLOAD_TOO_LARGE = 'payload_too_large';
}

final class CustomerErrorCode
{
    public const CUSTOMER_COULD_NOT_BE_RESOLVED = 'customer_could_not_be_resolved';
    public const CUSTOMER_EDIT_LINK_NOT_FOUND = 'customer_edit_link_not_found';
    public const CUSTOMER_EDIT_LINK_UNAVAILABLE = 'customer_edit_link_unavailable';
    public const CUSTOMER_EMAIL_REQUIRED = 'customer_email_required';
    public const CUSTOMER_HAS_INVOICES = 'customer_has_invoices';
    public const CUSTOMER_NOT_FOUND = 'customer_not_found';
    public const CUSTOMER_TAX_INFO_UNAVAILABLE = 'customer_tax_info_unavailable';
}

final class TaxInfoValidationCode
{
    public const LEGAL_NAME_MISMATCH = 'legal_name_mismatch';
    public const TAX_ADDRESS_ZIP_MISMATCH = 'tax_address_zip_mismatch';
    public const TAX_ID_NOT_FOUND = 'tax_id_not_found';
    public const TAX_SYSTEM_NOT_ALLOWED_FOR_TAX_ID = 'tax_system_not_allowed_for_tax_id';
    public const TAX_SYSTEM_NOT_IN_CATALOG = 'tax_system_not_in_catalog';
}

final class ProductErrorCode
{
    public const PRODUCT_NOT_FOUND = 'product_not_found';
}

final class SupplierErrorCode
{
    public const SUPPLIER_NOT_FOUND = 'supplier_not_found';
}

final class CatalogErrorCode
{
    public const PRODUCT_KEY_NOT_FOUND = 'product_key_not_found';
    public const TARIFF_CODE_NOT_FOUND = 'tariff_code_not_found';
    public const UNIT_KEY_NOT_FOUND = 'unit_key_not_found';
}

final class InvoiceErrorCode
{
    public const INVOICE_ALREADY_STAMPED = 'invoice_already_stamped';
    public const INVOICE_NOT_DRAFT = 'invoice_not_draft';
    public const INVOICE_NOT_FOUND = 'invoice_not_found';
    public const INVOICE_NOT_STAMPED = 'invoice_not_stamped';
}

final class InvoiceDraftErrorCode
{
    public const DRAFT_NOT_READY_TO_STAMP = 'draft_not_ready_to_stamp';
    public const DRAFT_UPDATE_IN_PROGRESS = 'draft_update_in_progress';
}

final class InvoiceStampingErrorCode
{
    public const INVOICE_STAMPING_FAILED = 'invoice_stamping_failed';
    public const INVOICE_STAMPING_SERVICE_UNAVAILABLE = 'invoice_stamping_service_unavailable';
    public const INVOICE_STAMPING_VALIDATION_ERROR = 'invoice_stamping_validation_error';
    public const MANIFESTO_SIGNATURE_FAILED = 'manifesto_signature_failed';
    public const STAMPING_IN_PROGRESS = 'stamping_in_progress';
}

final class InvoiceDeliveryErrorCode
{
    public const INVOICE_EMAIL_DELIVERY_FAILED = 'invoice_email_delivery_failed';
    public const INVOICE_EMAIL_RECIPIENT_REQUIRED = 'invoice_email_recipient_required';
    public const INVOICE_EMAIL_STATUS_NOT_ALLOWED = 'invoice_email_status_not_allowed';
}

final class InvoiceCancellationErrorCode
{
    public const INVOICE_CANCELLATION_IN_PROGRESS = 'invoice_cancellation_in_progress';
    public const INVOICE_CANCELLATION_RECEIPT_UNAVAILABLE = 'invoice_cancellation_receipt_unavailable';
    public const INVOICE_CANCELLATION_FAILED = 'invoice_cancellation_failed';
    public const INVOICE_CANCELLATION_NOT_ALLOWED = 'invoice_cancellation_not_allowed';
    public const INVOICE_CANCELLATION_NOT_FOUND = 'invoice_cancellation_not_found';
    public const INVOICE_CANCELLATION_RFC_MISMATCH = 'invoice_cancellation_rfc_mismatch';
    public const INVOICE_CANCELLATION_SERVICE_UNAVAILABLE = 'invoice_cancellation_service_unavailable';
    public const INVOICE_NOT_CANCELABLE = 'invoice_not_cancelable';
    public const INVOICE_NOT_CANCELABLE_BY_SAT = 'invoice_not_cancelable_by_sat';
    public const SUBSTITUTION_INVOICE_CANCELED = 'substitution_invoice_canceled';
    public const SUBSTITUTION_INVOICE_NOT_FOUND = 'substitution_invoice_not_found';
    public const SUBSTITUTION_INVOICE_REQUIRED = 'substitution_invoice_required';
    public const SUBSTITUTION_INVOICE_STATUS_NOT_ALLOWED = 'substitution_invoice_status_not_allowed';
}

final class ReceiptErrorCode
{
    public const RECEIPT_EXPIRED = 'receipt_expired';
    public const RECEIPT_NOT_FOUND = 'receipt_not_found';
    public const RECEIPT_NOT_OPEN = 'receipt_not_open';
}

final class ReceiptInvoicingErrorCode
{
    public const RECEIPT_INVOICING_ADDRESS_MISMATCH = 'receipt_invoicing_address_mismatch';
    public const RECEIPT_INVOICING_CUSTOMER_MISMATCH = 'receipt_invoicing_customer_mismatch';
    public const RECEIPT_INVOICING_TOO_MANY_ITEMS = 'receipt_invoicing_too_many_items';
    public const RECEIPT_KEYS_NOT_FOUND = 'receipt_keys_not_found';
}

final class ReceiptGlobalInvoiceErrorCode
{
    public const GLOBAL_INVOICE_TOO_MANY_ITEMS = 'global_invoice_too_many_items';
    public const INVALID_GLOBAL_INVOICE_PERIOD = 'invalid_global_invoice_period';
}

final class RetentionErrorCode
{
    public const INVALID_RETENTION_COMPLEMENT = 'invalid_retention_complement';
    public const RETENTION_NOT_FOUND = 'retention_not_found';
    public const RETENTION_NOT_STAMPED = 'retention_not_stamped';
    public const RETENTION_NOT_CANCELABLE = 'retention_not_cancelable';
}

final class RetentionDeliveryErrorCode
{
    public const RETENTION_EMAIL_DELIVERY_FAILED = 'retention_email_delivery_failed';
    public const RETENTION_EMAIL_RECIPIENT_REQUIRED = 'retention_email_recipient_required';
    public const RETENTION_EMAIL_STATUS_NOT_ALLOWED = 'retention_email_status_not_allowed';
}

final class RetentionCancellationErrorCode
{
    public const RETENTION_CANCELLATION_FAILED = 'retention_cancellation_failed';
    public const RETENTION_CANCELLATION_SERVICE_UNAVAILABLE = 'retention_cancellation_service_unavailable';
}

final class RetentionStampingErrorCode
{
    public const RETENTION_STAMPING_FAILED = 'retention_stamping_failed';
    public const RETENTION_STAMPING_SERVICE_UNAVAILABLE = 'retention_stamping_service_unavailable';
    public const RETENTION_STAMPING_VALIDATION_ERROR = 'retention_stamping_validation_error';
}

final class OrganizationErrorCode
{
    public const INVALID_OPERATION = 'invalid_operation';
    public const INVALID_USER_ID = 'invalid_user_id';
    public const ORGANIZATION_NOT_FOUND = 'organization_not_found';
    public const SUBSCRIPTION_ACTIVE_REQUIRED = 'subscription_active_required';
}

final class OrganizationSettingsErrorCode
{
    public const CERTIFICATE_EXPIRED = 'certificate_expired';
    public const CERTIFICATE_FILE_REQUIRED = 'certificate_file_required';
    public const CERTIFICATE_FILES_INVALID = 'certificate_files_invalid';
    public const CERTIFICATE_FILES_REQUIRED = 'certificate_files_required';
    public const CERTIFICATE_FIEL_RFC_MISMATCH = 'certificate_fiel_rfc_mismatch';
    public const CERTIFICATE_INVALID = 'certificate_invalid';
    public const CERTIFICATE_NOT_YET_VALID = 'certificate_not_yet_valid';
    public const CERTIFICATE_PREVIOUS_RFC_MISMATCH = 'certificate_previous_rfc_mismatch';
    public const CSD_REQUIRED = 'csd_required';
    public const FIEL_INVALID = 'fiel_invalid';
    public const FIEL_RFC_MISMATCH = 'fiel_rfc_mismatch';
    public const FIEL_REQUIRED = 'fiel_required';
    public const ORGANIZATION_DOMAIN_CHANGE_NOT_ALLOWED = 'organization_domain_change_not_allowed';
    public const ORGANIZATION_DOMAIN_UNAVAILABLE = 'organization_domain_unavailable';
    public const ORGANIZATION_SETTINGS_INVALID = 'organization_settings_invalid';
    public const ORGANIZATION_SUPPORT_EMAIL_REQUIRED = 'organization_support_email_required';
    public const ORGANIZATION_TAX_INFO_INVALID = 'organization_tax_info_invalid';
    public const PRIVATE_KEY_CERTIFICATE_MISMATCH = 'private_key_certificate_mismatch';
    public const PRIVATE_KEY_FILE_REQUIRED = 'private_key_file_required';
    public const PRIVATE_KEY_PASSWORD_INCORRECT = 'private_key_password_incorrect';
}

final class OrganizationInviteErrorCode
{
    public const INVITE_EMAIL_DELIVERY_FAILED = 'invite_email_delivery_failed';
    public const INVITE_EMAIL_MISMATCH = 'invite_email_mismatch';
    public const INVITE_EXPIRED = 'invite_expired';
    public const INVITE_NOT_FOUND = 'invite_not_found';
    public const INVITE_ROLE_UNAVAILABLE = 'invite_role_unavailable';
    public const USER_ALREADY_IN_ORGANIZATION = 'user_already_in_organization';
}

final class OrganizationAccessErrorCode
{
    public const ORGANIZATION_ADMIN_ACCESS_CANNOT_BE_REMOVED = 'organization_admin_access_cannot_be_removed';
    public const ORGANIZATION_ADMIN_ASSIGNMENT_CANNOT_BE_EDITED = 'organization_admin_assignment_cannot_be_edited';
    public const ORGANIZATION_ADMIN_ROLE_CANNOT_BE_DELETED = 'organization_admin_role_cannot_be_deleted';
    public const ORGANIZATION_ADMIN_ROLE_CANNOT_BE_EDITED = 'organization_admin_role_cannot_be_edited';
    public const ORGANIZATION_ADMIN_ROLE_REQUIRED = 'organization_admin_role_required';
    public const ORGANIZATION_ID_NOT_ALLOWED = 'organization_id_not_allowed';
    public const ORGANIZATION_ID_REQUIRED = 'organization_id_required';
    public const OWNER_ACCESS_CANNOT_BE_REASSIGNED = 'owner_access_cannot_be_reassigned';
    public const OWNER_ACCESS_CANNOT_BE_REMOVED = 'owner_access_cannot_be_removed';
    public const ROLE_HAS_ASSIGNED_USERS = 'role_has_assigned_users';
    public const ROLE_TEMPLATE_NOT_FOUND = 'role_template_not_found';
    public const ROLE_NOT_FOUND = 'role_not_found';
    public const USER_ACCESS_NOT_FOUND = 'user_access_not_found';
}

final class OrganizationSeriesErrorCode
{
    public const SERIES_ALREADY_EXISTS = 'series_already_exists';
    public const SERIES_NOT_FOUND = 'series_not_found';
}

final class WebhookErrorCode
{
    public const WEBHOOK_DELIVERY_ATTEMPT_NOT_FOUND = 'webhook_delivery_attempt_not_found';
    public const WEBHOOK_NOT_FOUND = 'webhook_not_found';
    public const WEBHOOK_SIGNATURE_INVALID = 'webhook_signature_invalid';
}

final class ToolErrorCode
{
    public const TAX_ID_VALIDATION_FAILED = 'tax_id_validation_failed';
    public const TAX_ID_VALIDATION_SERVICE_UNAVAILABLE = 'tax_id_validation_service_unavailable';
}

final class ValidationErrorCode
{
    public const AMOUNT_EXCEEDS_RELATED_DOCUMENT_BALANCE = 'amount_exceeds_related_document_balance';
    public const EXCHANGE_RATE_TOO_LARGE = 'exchange_rate_too_large';
    public const EXCHANGE_RATE_TOO_SMALL = 'exchange_rate_too_small';
    public const INVALID_FORMAT = 'invalid_format';
    public const INVALID_LENGTH = 'invalid_length';
    public const INVALID_TYPE = 'invalid_type';
    public const NOT_FOUND = 'not_found';
    public const NOT_ALLOWED = 'not_allowed';
    public const REQUIRED = 'required';
    public const TOO_LARGE = 'too_large';
    public const TOO_SMALL = 'too_small';
    public const UNKNOWN_FIELD = 'unknown_field';
    public const INVALID_VALUE = 'invalid_value';
}


# 3neti/contact

A Laravel package for managing **contacts as first-class domain entities**, with support for:

- normalized mobile numbers (via laravel-phone)
- schemaless attributes (via Spatie Schemaless Attributes)
- KYC workflows (via Hyperverge integration)
- bank account parsing and normalization
- media handling for identity and verification (via Spatie MediaLibrary)

This package is designed as a **core identity layer** within the x-change ecosystem, enabling reusable contact records across payments, vouchers, and onboarding flows.

---

## ✨ Core Concept

`Contact` represents a **person or entity** involved in financial or transactional workflows.

A contact can:
- hold mobile and country identity
- store flexible metadata (name, email, KYC data, etc.)
- manage bank account details
- participate in transactions (as sender/recipient)
- undergo KYC and face verification
- store media (IDs, selfies, verification attempts)

---

## 📦 Installation

```bash
composer require 3neti/contact
```

---

## ⚙️ Configuration

Publish config (optional):

```bash
php artisan vendor:publish --tag=config
```

---

## 🧱 Database Migrations

This package uses:

```php
loadMigrationsFrom()
```

So migrations are **auto-loaded**.

Run:

```bash
php artisan migrate
```

---

## ⚠️ Migration Notes

This package owns its own schema:

- `contacts` table
- meta column (schemaless)
- idempotency support

Test-only tables such as `users` and `inputs` are not part of runtime schema.

---

## 🧠 Usage

### Creating a Contact

```php
use LBHurtado\Contact\Models\Contact;

$contact = Contact::create([
    'mobile' => '09171234567',
    'country' => 'PH',
]);
```

---

### Mobile Normalization

```php
$contact->mobile;
```

Automatically normalized to proper dialing format.

---

### Bank Account Handling

```php
$contact->bank_account = 'BPI:1234567890';

$contact->bank_code;      
$contact->account_number;
```

Defaults to:

```text
BANK_CODE:MOBILE
```

---

### Metadata (Schemaless)

```php
$contact->name = 'Juan Dela Cruz';
$contact->email = 'juan@example.com';

$contact->save();
```

Stored in the `meta` JSON column.

---

### KYC

```php
$contact->kyc_status = 'approved';

$contact->isKycApproved();
$contact->needsKyc();
```

---

### Media Collections

- kyc_id_cards
- kyc_selfies
- face_reference_selfies
- face_verification_attempts
- face_reference_selfies_archive

---

### Relationships

```php
$contact->recipients();
```

Tracks transaction history and metadata.

---

### Webhook Integration

```php
Contact::fromWebhookSender($payload);
```

---

### Data Transformation

```php
use LBHurtado\Contact\Data\ContactData;

ContactData::fromModel($contact);
```

---

## 🧱 Schema

```text
contacts
- id
- mobile
- country
- bank_account
- meta (json)
- timestamps
```

---

## 🧩 Traits

- HasMobile
- HasMeta
- HasAdditionalAttributes
- HasBankAccount
- HasFaceVerification

---

## 🧭 Architecture Role

In the x-change ecosystem:

- contact = identity
- cash = value
- voucher = instruction
- wallet = ledger
- x-change = orchestration

---

## 🧪 Testing

- Testbench
- SQLite in-memory
- test-only migrations

---

## 🧾 License

Proprietary

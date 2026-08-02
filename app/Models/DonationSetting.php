<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class DonationSetting
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get donation settings.
     */
    public function get(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM donation_settings
            ORDER BY id
            LIMIT 1
        ");

        $settings = $stmt->fetch(PDO::FETCH_ASSOC);

        return $settings ?: [];
    }

    /**
     * Create default record.
     */
    public function create(): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO donation_settings (

                ministry_name,
                donation_title,
                donation_description,
                thank_you_message,

                enable_upi,
                enable_bank,
                enable_razorpay,
                enable_paypal,
                enable_stripe

            ) VALUES (

                :ministry_name,
                :donation_title,
                :donation_description,
                :thank_you_message,

                1,
                1,
                0,
                0,
                0

            )
        ");

        return $stmt->execute([

            'ministry_name'        => 'SingThyGlory',

            'donation_title'       => 'Support Our Ministry',

            'donation_description' => '',

            'thank_you_message'    => 'Thank you for supporting our ministry.'

        ]);
    }

    /**
     * Update donation settings.
     */
    public function update(array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE donation_settings
            SET

                ministry_name = :ministry_name,
                donation_title = :donation_title,
                donation_description = :donation_description,
                thank_you_message = :thank_you_message,

                enable_upi = :enable_upi,
                upi_name = :upi_name,
                upi_id = :upi_id,
                upi_qr_image = :upi_qr_image,

                enable_bank = :enable_bank,
                bank_name = :bank_name,
                account_name = :account_name,
                account_number = :account_number,
                ifsc_code = :ifsc_code,
                branch_name = :branch_name,
                swift_code = :swift_code,

                enable_razorpay = :enable_razorpay,
                razorpay_link = :razorpay_link,

                enable_paypal = :enable_paypal,
                paypal_link = :paypal_link,

                enable_stripe = :enable_stripe,
                stripe_link = :stripe_link

            WHERE id = :id
        ");

        return $stmt->execute($data);
    }
}
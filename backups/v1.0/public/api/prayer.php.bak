<?php

header('Content-Type: application/json');

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {

    $data = [

        "name" => trim($_POST['name'] ?? ''),
        "email" => trim($_POST['email'] ?? ''),
        "request" => trim($_POST['request'] ?? ''),
        "date" => date("Y-m-d H:i:s")

    ];

    // Save Prayer Request

    $file = __DIR__ . '/../storage/prayers.json';

    $existing = [];

    if(file_exists($file)) {

        $existing = json_decode(
            file_get_contents($file),
            true
        ) ?: [];

    }

    $existing[] = $data;

    file_put_contents(
        $file,
        json_encode($existing, JSON_PRETTY_PRINT)
    );

    // Random Encouragement Verse

    $verses = [

        [
            "text" => "Cast all your anxiety on Him because He cares for you.",
            "reference" => "1 Peter 5:7"
        ],

        [
            "text" => "Fear not, for I am with you.",
            "reference" => "Isaiah 41:10"
        ],

        [
            "text" => "Come to Me, all who labor and are heavy laden, and I will give you rest.",
            "reference" => "Matthew 11:28"
        ],

        [
            "text" => "The Lord is my Shepherd; I shall not want.",
            "reference" => "Psalm 23:1"
        ],

        [
            "text" => "I can do all things through Christ who strengthens me.",
            "reference" => "Philippians 4:13"
        ]

    ];

    $verse = $verses[array_rand($verses)];

    // Ministry Notification Email

    try {

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prayer@singthyglory.com';
        $mail->Password = 'YOUR_EMAIL_PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom(
            'prayer@singthyglory.com',
            'SingThyGlory Prayer Ministry'
        );

        $mail->addAddress(
            'prayer@singthyglory.com'
        );

        $mail->Subject =
            '🙏 New Prayer Request Received';

        $mail->Body =

"Name: {$data['name']}

Email: {$data['email']}

Prayer Request:

{$data['request']}

Date:

{$data['date']}";

        $mail->send();

    } catch(Exception $e) {

        error_log(
            "Ministry Mail Error: " .
            $e->getMessage()
        );

    }

    // Auto Reply To Visitor

    if(!empty($data['email'])) {

        try {

            $reply = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $reply->isSMTP();
            $reply->Host = 'smtp.hostinger.com';
            $reply->SMTPAuth = true;
            $reply->Username = 'prayer@singthyglory.com';
            $reply->Password = 'Prayer#2026';
            $reply->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $reply->Port = 465;

            $reply->setFrom(
                'prayer@singthyglory.com',
                'SingThyGlory Prayer Ministry'
            );

            $reply->addAddress(
                $data['email']
            );

            $reply->isHTML(true);

            $reply->Subject =
                '🙏 We Are Praying For You - SingThyGlory';

            $reply->Body = "

<h2>Dear {$data['name']},</h2>

<p>
Thank you for sharing your prayer request with us.
</p>

<p>
We have received your request and will be praying for you.
</p>

<h3>Your Submitted Prayer Request</h3>

<p>{$data['request']}</p>

<h3>Today's Encouragement Verse</h3>

<blockquote>

{$verse['text']}

<br><br>

<strong>{$verse['reference']}</strong>

</blockquote>

<p>
May the peace and comfort of Jesus Christ be with you.
</p>

<p>
God Bless You,<br>
SingThyGlory Prayer Ministry
</p>

";

            $reply->send();

        } catch(Exception $e) {

            error_log(
                "Auto Reply Error: " .
                $e->getMessage()
            );

        }

    }

    echo json_encode([
        "success" => true
    ]);

} catch(Exception $e) {

    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);

}
?>

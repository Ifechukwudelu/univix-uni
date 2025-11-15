<?php
// session_start();
include_once __DIR__ . '/php/db_config.php';
$message = "";
$redirectAfter = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']) ?? '';
    $subject = trim($_POST['subject']) ?? '';
    $messag = trim($_POST['message']) ?? '';

    if (empty($fullName) || empty($email) || empty($subject) || empty($messag)) {
        header("Location: /connect.php?error=empty_fields");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: connect.php?error=invalid_email");
        exit;
    }
    
    $connect = "INSERT INTO `connect`(`name`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE 
            name = VALUES(name),
            email = VALUES(email),
            subject = VALUES(subject),
            message = VALUES(message)";

    $stmt = $conn->prepare($connect);
    $stmt->bind_param("ssss", $fullName, $email, $subject, $messag);
    if($stmt->execute()){
        $message = "Thank you, we have received your information.";
    }else{
        $message = "Error, please retry";
    };
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us | Univix University</title>
    <link rel="icon" type="image/png" href="img/univix_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-sans text-gray-900">

    <?php include_once __DIR__ . '/php/header.php';?>

    <section class="bg-[#800000] text-white py-32 text-center mt-16">
        <h1 class="text-4xl font-bold mb-4">Get in Touch with Us</h1>
        <p class="text-gray-200 max-w-2xl mx-auto">
            Whether you’re a student, parent, or visitor, we’d love to hear from you.
            Reach out to Univix University for inquiries, assistance, or collaboration.
        </p>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-10 text-center">
            <div class="bg-white shadow-md p-8 rounded-lg hover:shadow-xl transition">
                <i data-lucide="map-pin" class="w-10 h-10 mx-auto text-[#800000] mb-4"></i>
                <h3 class="text-xl font-semibold text-[#800000] mb-2">Our Location</h3>
                <p class="text-gray-700 text-sm">Univix University Campus,<br> Off Independence Avenue,<br> Abuja,
                    Nigeria</p>
            </div>

            <div class="bg-white shadow-md p-8 rounded-lg hover:shadow-xl transition">
                <i data-lucide="phone" class="w-10 h-10 mx-auto text-[#800000] mb-4"></i>
                <h3 class="text-xl font-semibold text-[#800000] mb-2">Call Us</h3>
                <p class="text-gray-700 text-sm">
                    +234 701 234 5678 <br>
                    +234 812 345 6789
                </p>
            </div>

            <div class="bg-white shadow-md p-8 rounded-lg hover:shadow-xl transition">
                <i data-lucide="mail" class="w-10 h-10 mx-auto text-[#800000] mb-4"></i>
                <h3 class="text-xl font-semibold text-[#800000] mb-2">Email Us</h3>
                <p class="text-gray-700 text-sm">
                    info@univix.edu.ng <br>
                    admissions@univix.edu.ng
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-[#800000] mb-10">Send Us a Message</h2>

            <form class="grid md:grid-cols-2 gap-6" method="POST" enctype="multipart/form-data" >
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" placeholder="Your Name" required name="fullName"
                        class="w-full border-b border-gray-400 focus:border-[#800000] outline-none py-2 bg-transparent">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" placeholder="you@example.com" required name="email"
                        class="w-full border-b border-gray-400 focus:border-[#800000] outline-none py-2 bg-transparent">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" placeholder="Enter subject" required name="subject"
                        class="w-full border-b border-gray-400 focus:border-[#800000] outline-none py-2 bg-transparent">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Message</label>
                    <textarea rows="5" placeholder="Type your message here..." required name="message"
                        class="w-full border-b border-gray-400 focus:border-[#800000] outline-none py-2 bg-transparent"></textarea>
                </div>

                <div class="md:col-span-2 text-center">
                    <button type="submit"
                        class="bg-[#800000] text-white px-8 py-3 font-medium rounded hover:bg-[#9e0000] transition">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="py-0">
        <iframe class="w-full h-80" frameborder="0" style="border:0" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3969.404054368072!2d7.495081214774589!3d9.057851693489662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e75d9b87c7ef7%3A0x4e0bca0d078cf2db!2sAbuja%2C%20Nigeria!5e0!3m2!1sen!2sng!4v1708320121234"></iframe>
    </section>

    <?php include_once __DIR__ . '/php/footer.php';?>

    <script>
        lucide.createIcons();
    </script>
    <?php include_once __DIR__ . '/php/messageBox.php';?>

</body>

</html>
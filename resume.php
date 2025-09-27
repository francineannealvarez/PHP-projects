<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$showPopup = false;
if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    $showPopup = true;
    unset($_SESSION['login_success']); // para isang beses lang lumabas
}
?>


<?php
// Resume Data
$name = "Francine Anne V. Alvarez";
$contact = [
    "address" => "Ibaan, Batangas, Philippines",
    "phone"   => "0927 237 2484",
    "email"   => "23-09780@g.batstate-u.edu.ph",
    "linkedin" => "www.linkedin.com/in/francine-anne-alvarez" 
];

$education = [
    [
        "level" => "College",
        "school" => "Batangas State University",
        "degree" => "Bachelor of Science in Computer Science",
        "date" => "2023 - Present"
    ],
    [
        "level" => "Senior High School",
        "school" => "Dr. Juan A. Pastor Integrated National High School",
        "degree" => "STEM",
        "date" => "2021 – 2023"
    ],
    [
        "level" => "Junior High School",
        "school" => "Dr. Juan A. Pastor Integrated National High School",
        "degree" => "",
        "date" => "2017 – 2021"
    ],
    [
        "level" => "Elementary",
        "school" => "Piela Elementary School",
        "degree" => "",
        "date" => "2011 – 2017"
    ]
];

$skills = [
    "Programming: PHP, Java, Python, C++, HTML, CSS",
    "Databases: MySQL, PostgreSQL",
    "Tools: Git, Visual Studio Code"
];

$experience = [
    [
        "role" => "Intern",
        "company" => "BatStateU IT Department",
        "date" => "July 2024 – September 2024",
        "details" => [
            "Assisted in developing a student information system using PHP and MySQL.",
            "Performed debugging and troubleshooting for existing web applications.",
            "Collaborated with senior developers to improve database efficiency."
        ]
    ]
];

$activities = [
    [
        "organization" => "Junior Philippine Computer Society",
        "title" => "Director for Public Relations II",
        "date" => "2025 – 2026",
        "details" => [
            "Coordinated with local organizations for partnerships and sponsorship opportunities."
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Resume - <?php echo $name; ?></title>
<style>
    body {
        margin: 0;
        padding: 40px 0;
        font-family: "Times New Roman", serif;
        display: flex;
        justify-content: center; /* horizontally center */
    }

    .resume-container {
        width: 210mm;      /* approximate A4 width */
        padding: 40px 50px;
        background: #fff;  /* keep white */
    }

    h1 { 
        font-size: 24px; 
        text-transform: uppercase; 
        text-align: center; 
        font-weight: bold; 
        margin-bottom: 5px;
    }

    .contact {
        text-align: center;
        font-size: 14px;
        margin-bottom: 25px;
    }

    h2 { 
        font-size: 18px; 
        margin-top: 25px; 
        border-bottom: 1px solid #000; 
        padding-bottom: 3px;
    }

    .date { float: right; font-style: italic; }
    .clear { clear: both; }
    p { margin: 3px 0; }
    ul { margin: 5px 0 5px 20px; }

    .popup {
        position: fixed;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        background: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 25px; /* rounded like bubble */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: bold;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        opacity: 0;
        transition: all 0.6s ease-in-out;
        z-index: 1000;
    }

    .popup.show {
        top: 20px;      /* slide down */
        opacity: 1;
    }

    .popup.hide {
        top: -80px;     /* slide back up */
        opacity: 0;
    }

    .logout-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        background: #e0e0e0;  /* light gray */
        color: #d9534f;       /* bootstrap red */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: bold;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
    }
    .logout-btn:hover {
        background: #d6d6d6;   /* darker gray hover */
        color: #b52b27;        /* darker red */
        transform: scale(1.05); /* pop effect */
    }
</style>
</head>
<body>

<div class="resume-container">

    <!-- Header -->
    <h1><?php echo $name; ?></h1>
    <p class="contact">
        <?php echo $contact["address"]; ?> | 
        <?php echo $contact["phone"]; ?> | 
        <?php echo $contact["email"]; ?> 
        <?php if (!empty($contact["linkedin"])): ?> | 
            <?php echo $contact["linkedin"]; ?>
        <?php endif; ?>
    </p>

    <!-- Education -->
    <h2>Education</h2>
    <?php foreach ($education as $edu): ?>
        <p><b><?php echo $edu["school"]; ?></b> 
        <span class="date"><?php echo $edu["date"]; ?></span></p>
        <div class="clear"></div>
        <?php if (!empty($edu["degree"])): ?>
            <p style="margin-left: 40px;"><?php echo $edu["degree"]; ?></p>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Skills -->
    <h2>Skills</h2>
    <ul>
        <?php foreach ($skills as $s): ?>
            <li><?php echo $s; ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Experience -->
    <h2>Experience</h2>
    <?php foreach ($experience as $exp): ?>
    <p>
        <b>
        <?php 
            if (!empty($exp["role"]) && !empty($exp["company"])) {
                echo htmlspecialchars($exp["role"] . ", " . $exp["company"]);
            } elseif (!empty($exp["role"])) {
                echo htmlspecialchars($exp["role"]);
            } elseif (!empty($exp["company"])) {
                echo htmlspecialchars($exp["company"]);
            }
        ?>
        </b>
        <span class="date"><?php echo htmlspecialchars($exp["date"]); ?></span>
    </p>
    <div class="clear"></div>

    <?php 
    $cleanDetails = array_filter($exp["details"], function($v){ return trim((string)$v) !== ""; });
    if (!empty($cleanDetails)): ?>
        <ul>
            <?php foreach ($cleanDetails as $d): ?>
                <li><?php echo htmlspecialchars($d); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php endforeach; ?>

    <!-- Activities -->
    <h2>Leadership & Activities</h2>
    <?php foreach ($activities as $act): ?>
        <p><b><?php echo $act["organization"]; ?> – <?php echo $act["title"]; ?></b> 
        <span class="date"><?php echo $act["date"]; ?></span></p>
        <div class="clear"></div>
        <ul>
            <?php foreach ($act["details"] as $d): ?>
                <li><?php echo $d; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

</div> <!-- end resume-container -->

    <?php if ($showPopup): ?>
        <div id="successPopup" class="popup">✅ Login Successful</div>
        <script>
            const popup = document.getElementById("successPopup");
            popup.classList.add("show");
            setTimeout(() => {
                popup.classList.remove("show");
                popup.classList.add("hide");
            }, 2500);
        </script>
    <?php endif; ?>

    <br><br>
    <p style="text-align:center; margin-top:30px;">
        <a href="logout.php" class="logout-btn">Logout</a>
    </p>
    
</body>
</html>


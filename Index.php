<?php
/* ============================================================
   KOLITHA SANDEEPA — index.php
   Portfolio · Real CV Data Updated
   ============================================================ */

/* ── CONTACT FORM HANDLER (AJAX POST) ─────────────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['action']) && $_POST['action'] === 'contact') {

    header('Content-Type: application/json');

    $name    = htmlspecialchars(trim($_POST['name']    ?? ''), ENT_QUOTES, 'UTF-8');
    $email   = filter_var(trim($_POST['email']   ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']  ?? 'Portfolio Contact'), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($_POST['message']  ?? ''), ENT_QUOTES, 'UTF-8');

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['ok' => false, 'error' => 'All fields are required.']);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['ok' => false, 'error' => 'Invalid email address.']);
        exit;
    }

    $to      = 'kolithasandeepa111@gmail.com';
    $headers = "From: {$name} <{$email}>\r\n"
             . "Reply-To: {$email}\r\n"
             . "Content-Type: text/plain; charset=UTF-8\r\n"
             . "X-Mailer: PHP/" . phpversion();

    $body    = "Name:    {$name}\n"
             . "Email:   {$email}\n"
             . "Subject: {$subject}\n\n"
             . "Message:\n{$message}\n";

    $sent = mail($to, "[Portfolio] {$subject}", $body, $headers);

    echo json_encode($sent
        ? ['ok' => true]
        : ['ok' => false, 'error' => 'Mail could not be sent. Please try again later.']
    );
    exit;
}

/* ── BASE URL ─────────────────────────────────────────────── */
$baseUrl = rtrim(dirname($_SERVER['PHP_SELF']), '/');

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Kolitha Sandeepa — Software Engineering Student and Web Developer at NIBM Sri Lanka. Specialising in PHP, Java, React, Flutter, Firebase and full-stack systems." />
  <meta name="author" content="Kolitha Sandeepa" />
  <meta property="og:title"       content="Kolitha Sandeepa — Software Engineering Student" />
  <meta property="og:description" content="Portfolio of Kolitha Sandeepa — building efficient, scalable, and user-friendly software solutions that create real-world impact." />
  <meta property="og:type"        content="website" />

  <title>Kolitha Sandeepa — Software Engineering Student</title>

  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= $baseUrl ?>/style.css" />
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💻</text></svg>" />
</head>
<body>

<!-- ═══════════════════════════════════════
     NAVIGATION
═══════════════════════════════════════ -->
<nav id="navbar" role="navigation" aria-label="Main navigation">

  <a href="#home" class="nav-logo" aria-label="Kolitha Sandeepa home">
    K<span class="nav-logo-dot">.</span>Sandeepa
  </a>

  <ul class="nav-links">
    <li><a href="#home"     class="active">Home</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#skills">Skills</a></li>
    <li><a href="#projects">Projects</a></li>
    <li><a href="#resume">Resume</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>

  <a href="#contact" class="btn btn-primary nav-hire">Hire Me</a>

  <button class="hamburger" id="hamburger"
          aria-label="Toggle mobile menu" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- Mobile overlay -->
<nav class="mobile-nav" id="mobile-nav" aria-label="Mobile navigation">
  <a href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#skills">Skills</a>
  <a href="#projects">Projects</a>
  <a href="#resume">Resume</a>
  <a href="#contact">Contact</a>
</nav>


<!-- ═══════════════════════════════════════
     HERO — HOME
═══════════════════════════════════════ -->
<section id="home" aria-label="Hero section">
  <canvas id="hero-canvas" aria-hidden="true"></canvas>
  <div class="hero-glow-1" aria-hidden="true"></div>
  <div class="hero-glow-2" aria-hidden="true"></div>

  <div class="container">
    <div class="hero-grid">

      <!-- Left: text content -->
      <div class="hero-content">

        <div class="hero-badge anim-up">
          <span class="badge">👋 &nbsp;Available for Internships &amp; Opportunities</span>
        </div>

        <h1 class="hero-heading anim-up d1">
          Hi, I'm<br>
          <span class="hl">Kolitha Sandeepa</span>
        </h1>

        <p class="hero-sub anim-up d2">
          <span id="typewriter">Software Engineer</span>
          <span class="sep">|</span>
          Web Developer
        </p>

        <p class="hero-bio anim-up d3">
          Motivated Software Engineering student at NIBM Sri Lanka with a passion
          for building efficient, scalable, and user-friendly software. Experienced
          in web, mobile, desktop, and IoT systems — I transform complex problems
          into clean, maintainable solutions that create real-world impact.
        </p>

        <div class="hero-ctas anim-up d4">
          <a href="#projects" class="btn btn-primary">
            <i class="fas fa-folder-open"></i> View Projects
          </a>
          <a href="#contact" class="btn btn-ghost">
            <i class="fas fa-paper-plane"></i> Contact Me
          </a>
        </div>

        <!-- Stats row -->
        <div class="hero-stats anim-up d5">
          <div>
            <div class="stat-num"><span data-count="6">6</span><sup>+</sup></div>
            <div class="stat-label">Projects Built</div>
          </div>
          <div>
            <div class="stat-num"><span data-count="2">2</span><sup>+</sup></div>
            <div class="stat-label">Years at NIBM</div>
          </div>
          <div>
            <div class="stat-num"><span data-count="12">12</span><sup>+</sup></div>
            <div class="stat-label">Technologies</div>
          </div>
        </div>

      </div><!-- /hero-content -->

      <!-- Right: animated avatar -->
      <div class="hero-visual" aria-hidden="true">
        <div class="avatar-scene">
          <div class="av-blob"></div>
          <div class="av-ring">
            <div class="av-ring-pip"></div>
          </div>
          <div class="av-inner">
            <span>👨‍💻</span>
          </div>
          <div class="av-status">
            <div class="av-status-dot"></div>
            <span class="av-status-text">Open to work</span>
          </div>
          <div class="float-chip float-chip-1">
            <span class="chip-icon">⚛️</span> React &amp; Spring Boot
          </div>
          <div class="float-chip float-chip-2">
            <span class="chip-icon">📱</span> Flutter Dev
          </div>
        </div>
      </div>

    </div><!-- /hero-grid -->
  </div><!-- /container -->
</section>


<!-- ═══════════════════════════════════════
     ABOUT
═══════════════════════════════════════ -->
<section id="about" class="section section-alt" aria-label="About me">
  <div class="container">
    <div class="about-grid">

      <!-- Left: photo placeholder -->
      <div class="about-img-col anim-left">
        <div class="about-photo">
          <span style="position:relative;z-index:1;">🧑‍🎓</span>
          <div class="about-photo-overlay"></div>
        </div>
        <div class="about-counter">
          <div class="about-counter-num">HND</div>
          <div class="about-counter-label">Software Eng.</div>
        </div>
      </div>

      <!-- Right: bio -->
      <div class="about-body anim-right">
        <div class="eyebrow">
          <span class="eyebrow-text">About Me</span>
        </div>
        <h2 class="section-title">
          Building Software<br>
          With <span>Real Impact</span>
        </h2>

        <p>
          I'm <strong>Kolitha Sandeepa</strong>, a motivated Software Engineering
          student at the <strong>National Institute of Business Management (NIBM),
          Sri Lanka</strong>. I have a strong interest in web development and system
          design, with hands-on experience building web, mobile, desktop, and
          embedded IoT solutions.
        </p>
        <p>
          I demonstrate strong problem-solving ability, teamwork, and attention to
          detail through my academic and practical projects. I aspire to become a
          skilled Software Engineer and professional Web Developer — building
          efficient, scalable software that creates real-world impact.
        </p>
        <p>
          Currently pursuing my <strong>Higher National Diploma (HND) in Software
          Engineering</strong> at NIBM (2025–Present), building on my completed
          <strong>Diploma in Software Engineering</strong> (2024–2025). I also hold
          an English Language Certificate from the Open University of Sri Lanka.
        </p>

        <h3>Interests &amp; Passions</h3>
        <div class="interests-list">
          <div class="interest-tag"><span class="icon">🌐</span> Web Development</div>
          <div class="interest-tag"><span class="icon">☕</span> Java &amp; Spring Boot</div>
          <div class="interest-tag"><span class="icon">📱</span> Flutter &amp; Mobile</div>
          <div class="interest-tag"><span class="icon">🤖</span> AI Technologies</div>
          <div class="interest-tag"><span class="icon">🔥</span> Firebase &amp; Cloud</div>
          <div class="interest-tag"><span class="icon">🛠️</span> IoT &amp; Robotics</div>
        </div>

        <div class="info-grid">
          <div class="info-card">
            <div class="lbl">Location</div>
            <div class="val">Kurunegala, Sri Lanka 🇱🇰</div>
          </div>
          <div class="info-card">
            <div class="lbl">Status</div>
            <div class="val" style="color:var(--orange)">Open to Work</div>
          </div>
          <div class="info-card">
            <div class="lbl">Degree</div>
            <div class="val">HND Software Eng.</div>
          </div>
          <div class="info-card">
            <div class="lbl">Institute</div>
            <div class="val">NIBM Sri Lanka</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════
     SKILLS
═══════════════════════════════════════ -->
<section id="skills" class="section" aria-label="Skills section">
  <div class="container">

    <!-- Intro row -->
    <div class="skills-intro">
      <div class="anim-left">
        <div class="eyebrow"><span class="eyebrow-text">Skills</span></div>
        <h2 class="section-title">
          My Technical<br><span>Arsenal</span>
        </h2>
        <p class="section-sub">
          Skills built through real NIBM projects and personal development across
          web, mobile, desktop, and embedded systems — always growing.
        </p>
      </div>

      <div class="anim-right" style="display:flex;align-items:center;">
        <div style="background:var(--bg-card);border:1px solid var(--orange-border);
                    border-radius:var(--radius-xl);padding:32px;width:100%;">
          <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.18em;
                      text-transform:uppercase;color:var(--orange);margin-bottom:14px;">
            Core Knowledge
          </div>
          <p style="color:var(--text-2);font-size:0.92rem;line-height:1.8;">
            Strong foundation in OOP, REST APIs, System Analysis, Authentication,
            Database Design, and Software Testing — applied across every project
            I build. Soft skills include Problem Solving, Teamwork, Communication,
            and Time Management.
          </p>
          <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;">
            <span class="badge">🎯 Problem Solving</span>
            <span class="badge">🤝 Teamwork</span>
            <span class="badge">🚀 Project-based</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Skill bars — 2 columns -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px 64px;margin-bottom:56px;"
         id="skill-bars-section">

      <!-- Col 1 -->
      <div class="skill-bars-col anim-left">
        <?php
        $skillsLeft = [
          ['icon' => '🌐', 'name' => 'HTML5 &amp; CSS3',  'pct' => 90],
          ['icon' => '⚡', 'name' => 'JavaScript',         'pct' => 82],
          ['icon' => '🐘', 'name' => 'PHP',                'pct' => 85],
          ['icon' => '⚛️', 'name' => 'React',              'pct' => 75],
          ['icon' => '🌿', 'name' => 'Spring Boot',        'pct' => 72],
          ['icon' => '📱', 'name' => 'Flutter',            'pct' => 70],
        ];
        foreach ($skillsLeft as $s): ?>
        <div class="skill-row">
          <div class="skill-top">
            <span class="skill-name">
              <span class="skill-icon"><?= $s['icon'] ?></span>
              <?= $s['name'] ?>
            </span>
            <span class="skill-pct"><?= $s['pct'] ?>%</span>
          </div>
          <div class="skill-track">
            <div class="skill-fill" data-target="<?= $s['pct'] ?>"></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Col 2 -->
      <div class="skill-bars-col anim-right">
        <?php
        $skillsRight = [
          ['icon' => '☕', 'name' => 'Java',                'pct' => 80],
          ['icon' => '🔷', 'name' => 'C# &amp; .NET',      'pct' => 72],
          ['icon' => '🗄️', 'name' => 'MySQL / SQL Server', 'pct' => 82],
          ['icon' => '🔥', 'name' => 'Firebase',            'pct' => 78],
          ['icon' => '🔀', 'name' => 'Git &amp; GitHub',    'pct' => 85],
          ['icon' => '🤖', 'name' => 'ESP32 / Arduino IoT', 'pct' => 65],
        ];
        foreach ($skillsRight as $s): ?>
        <div class="skill-row">
          <div class="skill-top">
            <span class="skill-name">
              <span class="skill-icon"><?= $s['icon'] ?></span>
              <?= $s['name'] ?>
            </span>
            <span class="skill-pct"><?= $s['pct'] ?>%</span>
          </div>
          <div class="skill-track">
            <div class="skill-fill" data-target="<?= $s['pct'] ?>"></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Tech icon grid -->
    <div class="anim-up">
      <h3 style="font-family:var(--ff-head);font-size:0.85rem;font-weight:700;
                 letter-spacing:0.14em;text-transform:uppercase;color:var(--text-3);
                 margin-bottom:20px;">
        Full Tech Stack
      </h3>
      <div class="tech-icon-grid">
        <?php
        $techIcons = [
          ['🌐','HTML'],    ['🎨','CSS'],      ['⚡','JS'],       ['🐘','PHP'],
          ['☕','Java'],    ['🔷','C#'],        ['🌿','Spring'],   ['⚛️','React'],
          ['📱','Flutter'], ['🗄️','MySQL'],   ['🔥','Firebase'], ['🐙','GitHub'],
        ];
        foreach ($techIcons as [$ico, $name]): ?>
        <div class="tech-icon-card">
          <div class="tic-emoji"><?= $ico ?></div>
          <div class="tic-name"><?= $name ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════
     PROJECTS
═══════════════════════════════════════ -->
<section id="projects" class="section section-alt" aria-label="Projects section">
  <div class="container">

    <div class="projects-header anim-up">
      <div class="eyebrow" style="justify-content:center;">
        <span class="eyebrow-text">Projects</span>
      </div>
      <h2 class="section-title">Things I've <span>Built</span></h2>
      <p class="section-sub">
        Real academic and personal projects spanning web, mobile, desktop,
        and embedded IoT systems — each one a new chapter in my journey.
      </p>
    </div>

    <?php
    $projects = [
      [
        'emoji'    => '🤖',
        'bgGrad'   => 'linear-gradient(135deg,#07071a,#0d0f32)',
        'badgeTxt' => 'AI Powered',
        'badgeClr' => 'background:rgba(139,92,246,0.15);color:#c4b5fd;border-color:rgba(139,92,246,0.3)',
        'title'    => 'AI-Integrated Web-Based Restaurant Management System',
        'desc'     => 'Admin dashboard built with PHP, HTML, CSS, and JavaScript. Integrated Firebase Firestore for the database with real-time menu management, order tracking, and reporting features.',
        'tech'     => ['PHP','HTML','CSS','JavaScript','Firebase Firestore'],
        'github'   => 'https://github.com/Dasanayaka-K-S',
        'demo'     => null,
      ],
      [
        'emoji'    => '🍽️',
        'bgGrad'   => 'linear-gradient(135deg,#1a0f00,#2d1600)',
        'badgeTxt' => 'Mobile App',
        'badgeClr' => 'background:rgba(249,115,22,0.12);color:#fb923c;border-color:rgba(249,115,22,0.3)',
        'title'    => 'Restaurant Management &amp; Food Ordering Mobile App',
        'desc'     => 'Cross-platform mobile food ordering system built with Flutter and Firebase. Features real-time order tracking, an admin dashboard, and a complete delivery management module.',
        'tech'     => ['Flutter','Firebase','Dart'],
        'github'   => 'https://github.com/Dasanayaka-K-S',
        'demo'     => null,
      ],
      [
        'emoji'    => '🦾',
        'bgGrad'   => 'linear-gradient(135deg,#001020,#002040)',
        'badgeTxt' => 'IoT / Robotics',
        'badgeClr' => 'background:rgba(34,197,94,0.1);color:#86efac;border-color:rgba(34,197,94,0.3)',
        'title'    => 'Assistive Service Robot for Elderly Care',
        'desc'     => 'ESP32-based indoor assistive robot with obstacle avoidance and Wi-Fi smartphone control. Features a servo-operated robotic arm and real-time sensor-based navigation for elderly assistance.',
        'tech'     => ['ESP32','Arduino IDE','IoT','C++','Servo Motors'],
        'github'   => 'https://github.com/Dasanayaka-K-S',
        'demo'     => null,
      ],
      [
        'emoji'    => '🚗',
        'bgGrad'   => 'linear-gradient(135deg,#0a1500,#162500)',
        'badgeTxt' => 'Desktop App',
        'badgeClr' => 'background:rgba(234,179,8,0.1);color:#fde047;border-color:rgba(234,179,8,0.3)',
        'title'    => 'Vehicle Service Management System (C# Desktop)',
        'desc'     => 'Windows Forms application built with C# and .NET featuring secure user login, automated billing, service record management, and detailed report generation using SQL Server.',
        'tech'     => ['C#','.NET','SQL Server','Windows Forms'],
        'github'   => 'https://github.com/Dasanayaka-K-S',
        'demo'     => null,
      ],
      [
        'emoji'    => '🐾',
        'bgGrad'   => 'linear-gradient(135deg,#0f001a,#1e0030)',
        'badgeTxt' => 'Full Stack',
        'badgeClr' => 'background:rgba(139,92,246,0.15);color:#c4b5fd;border-color:rgba(139,92,246,0.3)',
        'title'    => 'Pet Shop Management System',
        'desc'     => 'Full-stack system with Spring Boot RESTful APIs and React front-end. Includes appointment scheduling with business rule validation, secure authentication, and comprehensive API testing with JUnit and Postman. Developed as a team project.',
        'tech'     => ['Spring Boot','React','MySQL','JUnit','Postman'],
        'github'   => 'https://github.com/Dasanayaka-K-S',
        'demo'     => null,
      ],
      [
        'emoji'    => '🔧',
        'bgGrad'   => 'linear-gradient(135deg,#001a0a,#002e15)',
        'badgeTxt' => 'Java OOP',
        'badgeClr' => 'background:rgba(249,115,22,0.12);color:#fb923c;border-color:rgba(249,115,22,0.3)',
        'title'    => 'Vehicle Service Management System (Java OOP)',
        'desc'     => 'Console-based Java application applying core OOP principles — encapsulation, inheritance, and polymorphism — for vehicle service selection and automated cost calculation.',
        'tech'     => ['Java','OOP','Console App'],
        'github'   => 'https://github.com/Dasanayaka-K-S',
        'demo'     => null,
      ],
    ];
    ?>

    <div class="projects-grid">
      <?php foreach ($projects as $i => $p):
        $delay = 'd' . (($i % 2) + 1);
      ?>
      <div class="p-card anim-up <?= $delay ?>">
        <div class="p-thumb" style="background:<?= $p['bgGrad'] ?>">
          <?= $p['emoji'] ?>
          <div class="p-thumb-badge">
            <span class="badge" <?= $p['badgeClr'] ? 'style="'.$p['badgeClr'].'"' : '' ?>>
              <?= $p['badgeTxt'] ?>
            </span>
          </div>
        </div>
        <div class="p-body">
          <h3 class="p-title"><?= $p['title'] ?></h3>
          <p class="p-desc"><?= $p['desc'] ?></p>
          <div class="p-tags">
            <?php foreach ($p['tech'] as $t): ?>
            <span class="p-tag"><?= htmlspecialchars($t) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="p-actions">
            <a href="<?= $p['github'] ?>" class="btn btn-primary btn-sm"
               target="_blank" rel="noopener">
              <i class="fab fa-github"></i> GitHub
            </a>
            <?php if ($p['demo']): ?>
            <a href="<?= $p['demo'] ?>" class="btn btn-outline btn-sm"
               target="_blank" rel="noopener">
              <i class="fas fa-external-link-alt"></i> Live Demo
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════
     RESUME
═══════════════════════════════════════ -->
<section id="resume" class="section" aria-label="Resume section">
  <div class="container">
    <div class="resume-grid">

      <!-- Left: CV mockup + highlights -->
      <div class="resume-mockup anim-left">
        <div class="cv-page">
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
          <div class="cv-bar"></div>
        </div>
        <div class="resume-features">
          <?php
          $feats = [
            ['🎓', 'HND in Software Engineering — NIBM (2025–Present)'],
            ['📜', 'Diploma in Software Engineering — NIBM (2024–2025)'],
            ['🌐', 'English Language Certificate — Open University of Sri Lanka'],
            ['💻', '6+ Real-world projects: web, mobile, desktop &amp; IoT'],
            ['🔬', 'API testing experience with JUnit &amp; Postman'],
            ['🤝', 'Team project experience in agile environments'],
          ];
          foreach ($feats as [$ic, $txt]): ?>
          <div class="res-feat">
            <span class="res-feat-icon"><?= $ic ?></span>
            <span><?= $txt ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right: timeline + download -->
      <div class="resume-content anim-right">
        <div class="eyebrow"><span class="eyebrow-text">Resume</span></div>
        <h2 class="section-title">My Learning <span>Journey</span></h2>

        <p>
          My academic path at NIBM and my growing project portfolio reflect a
          consistent commitment to building real software across web, mobile,
          desktop, and embedded domains — from PHP dashboards to Flutter apps
          and IoT robots.
        </p>

        <div class="timeline">
          <?php
          $timeline = [
            [
              '2025 – Present',
              'HND in Software Engineering',
              'National Institute of Business Management (NIBM), Sri Lanka',
            ],
            [
              '2025',
              'Pet Shop Management System',
              'Spring Boot · React · MySQL · JUnit · Postman (Team Project)',
            ],
            [
              '2024 – 2025',
              'Diploma in Software Engineering',
              'National Institute of Business Management (NIBM), Sri Lanka',
            ],
            [
              '2024',
              'AI-Integrated Restaurant System',
              'PHP · JavaScript · Firebase Firestore · Real-time Reporting',
            ],
            [
              '2024',
              'Assistive Service Robot for Elderly Care',
              'ESP32 · Arduino IDE · IoT · Servo-operated Robotic Arm',
            ],
            [
              '2024',
              'Restaurant Mobile App &amp; Vehicle Service Systems',
              'Flutter · Firebase · C# .NET · Java OOP',
            ],
          ];
          foreach ($timeline as [$yr, $title, $sub]): ?>
          <div class="t-item">
            <div class="t-dot"></div>
            <div class="t-body">
              <div class="t-year"><?= $yr ?></div>
              <div class="t-title"><?= $title ?></div>
              <div class="t-sub"><?= $sub ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="resume-btns">
          <a href="cv/sandeepa_cv.pdf" download class="btn btn-primary">
            <i class="fas fa-download"></i> Download CV
          </a>
          <a href="cv/sandeepa_cv.pdf" target="_blank" rel="noopener" class="btn btn-ghost">
            <i class="fas fa-eye"></i> View Online
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════
     CONTACT
═══════════════════════════════════════ -->
<section id="contact" class="section section-alt" aria-label="Contact section">
  <div class="container">

    <div class="contact-header anim-up">
      <div class="eyebrow" style="justify-content:center;">
        <span class="eyebrow-text">Contact</span>
      </div>
      <h2 class="section-title">Let's <span>Work Together</span></h2>
      <p class="section-sub">
        Have a project, internship opportunity, or just want to talk tech?
        I'd love to hear from you — I typically reply within 24 hours.
      </p>
    </div>

    <div class="contact-grid">

      <!-- Left: contact info cards -->
      <div class="anim-left">
        <p class="contact-info-title">Get In Touch</p>
        <p class="contact-info-sub">
          Based in Kurunegala, Sri Lanka. Available for remote or local work.
        </p>

        <div class="contact-cards">
          <?php
          $contacts = [
            [
              '📞', 'Phone',
              '+94 77 045 9504',
              'tel:+94770459504',
            ],
            [
              '📧', 'Email',
              'kolithasandeepa111@gmail.com',
              'mailto:kolithasandeepa111@gmail.com',
            ],
            [
              '🐙', 'GitHub',
              'github.com/Dasanayaka-K-S',
              'https://github.com/Dasanayaka-K-S',
            ],
            [
              '💼', 'LinkedIn',
              'linkedin.com/in/kolitha-sandeepa',
              'https://www.linkedin.com/in/kolitha-sandeepa',
            ],
          ];
          foreach ($contacts as [$icon, $lbl, $val, $href]): ?>
          <a href="<?= $href ?>" target="_blank" rel="noopener" class="c-card">
            <div class="c-icon-wrap"><?= $icon ?></div>
            <div>
              <div class="c-lbl"><?= $lbl ?></div>
              <div class="c-val"><?= $val ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>

        <div style="margin-top:24px;background:var(--orange-subtle);
                    border:1px solid var(--orange-border);border-radius:var(--radius-md);
                    padding:16px 20px;display:flex;align-items:center;gap:10px;">
          <span style="font-size:18px">✅</span>
          <span style="font-size:0.84rem;color:var(--text-2);font-weight:500;">
            Currently open to internships &amp; freelance projects
          </span>
        </div>
      </div>

      <!-- Right: contact form -->
      <div class="anim-right">
        <div class="contact-form-wrap">
          <form id="contact-form" novalidate>
            <input type="hidden" name="action" value="contact">

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="f-name">
                  Name <span style="color:var(--orange)">*</span>
                </label>
                <input type="text" id="f-name" name="name"
                       class="form-input" placeholder="Your full name"
                       autocomplete="name" required>
              </div>
              <div class="form-group">
                <label class="form-label" for="f-email">
                  Email <span style="color:var(--orange)">*</span>
                </label>
                <input type="email" id="f-email" name="email"
                       class="form-input" placeholder="you@example.com"
                       autocomplete="email" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="f-subject">Subject</label>
              <input type="text" id="f-subject" name="subject"
                     class="form-input" placeholder="What is this about?">
            </div>

            <div class="form-group">
              <label class="form-label" for="f-message">
                Message <span style="color:var(--orange)">*</span>
              </label>
              <textarea id="f-message" name="message"
                        class="form-textarea"
                        placeholder="Tell me about your project or enquiry…"
                        required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
              <i class="fas fa-paper-plane"></i> Send Message
            </button>

            <div class="form-msg" id="form-success">
              ✅ &nbsp;Your message was sent! I'll reply within 24 hours.
            </div>
            <div class="form-err-msg" id="form-error"></div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════
     FOOTER
═══════════════════════════════════════ -->
<footer role="contentinfo">
  <div class="container">
    <div class="footer-inner">
      <a href="#home" class="footer-logo">
        K.Sandeepa<span style="color:var(--orange)">.</span>
      </a>
      <p class="footer-copy">
        &copy; <?= date('Y') ?> Kolitha Sandeepa. Crafted with ❤️ &amp; ☕
      </p>
      <div class="footer-socials">
        <a href="https://github.com/Dasanayaka-K-S"
           target="_blank" rel="noopener" class="f-social" aria-label="GitHub">
          <i class="fab fa-github"></i>
        </a>
        <a href="https://www.linkedin.com/in/kolitha-sandeepa"
           target="_blank" rel="noopener" class="f-social" aria-label="LinkedIn">
          <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="mailto:kolithasandeepa111@gmail.com"
           class="f-social" aria-label="Email">
          <i class="fas fa-envelope"></i>
        </a>
        <a href="tel:+94770459504"
           class="f-social" aria-label="Phone">
          <i class="fas fa-phone"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

<script src="<?= $baseUrl ?>/script.js" defer></script>
</body>
</html>
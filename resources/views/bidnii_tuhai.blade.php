<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бидний тухай - E-Parking</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* ══════════ HEADER ══════════ */
        .header {
            background: #ffffff;
            padding: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            padding: 14px 0;
        }

        .logo { display: flex; align-items: center; gap: 10px; }
        .logo h1 { color: #667eea; font-size: 26px; }
        .logo-icon { font-size: 32px; }

        nav { display: flex; gap: 28px; }
        nav a { color: #333; text-decoration: none; font-weight: 500; transition: color .3s; cursor: pointer; }
        nav a:hover { color: #667eea; }

        .header-auth { display: flex; align-items: center; gap: 10px; }

        .btn-login {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            transition: all .2s;
        }
        .btn-login:hover { background: #667eea; color: #fff; }

        .user-pill {
            display: none;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            border: 1.5px solid #e9ecef;
            padding: 7px 16px 7px 10px;
            border-radius: 50px;
        }
        .user-pill.show { display: flex; }
        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }
        .user-name { font-size: 14px; font-weight: 600; color: #333; }
        .btn-logout {
            background: none;
            border: none;
            color: #999;
            font-size: 13px;
            cursor: pointer;
            font-family: inherit;
            transition: color .2s;
        }
        .btn-logout:hover { color: #dc3545; }

        /* ══════════ PAGE TITLE ══════════ */
        .page-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 60px 20px;
        }

        .page-hero h1 { font-size: 48px; margin-bottom: 10px; }
        .page-hero p { font-size: 18px; opacity: 0.95; }

        /* ══════════ CONTENT ══════════ */
        .content-section {
            background: white;
            margin: 40px auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,.2);
        }

        .section-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        }

        /* ══════════ COMPANY INFO ══════════ */
        .company-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
            border-left: 4px solid #667eea;
        }

        .company-info h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .company-info p {
            color: #555;
            line-height: 1.8;
            margin-bottom: 15px;
            font-size: 15px;
        }

        /* ══════════ GOALS & OBJECTIVES ══════════ */
        .goals-section {
            margin-bottom: 50px;
        }

        .goals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .goal-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
            transition: transform .3s, box-shadow .3s;
        }

        .goal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,.2);
        }

        .goal-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .goal-card p {
            font-size: 14px;
            line-height: 1.6;
            opacity: 0.95;
        }

        /* ══════════ TEAM SECTION ══════════ */
        .team-section {
            margin-top: 50px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .cv-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .3s, box-shadow .3s;
            box-shadow: 0 4px 10px rgba(0,0,0,.08);
        }

        .cv-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,.15);
            border-color: #667eea;
        }

        .cv-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .cv-avatar {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            box-shadow: 0 4px 10px rgba(0,0,0,.2);
        }

        .cv-name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .cv-position {
            font-size: 14px;
            opacity: 0.9;
        }

        .cv-body {
            padding: 25px;
        }

        .cv-section {
            margin-bottom: 20px;
        }

        .cv-section-title {
            font-size: 13px;
            font-weight: 700;
            color: #667eea;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e9ecef;
        }

        .cv-item {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .cv-item-title {
            font-weight: 600;
            color: #333;
        }

        .cv-item-subtitle {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .skill-tag {
            background: #f0f2f5;
            color: #667eea;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ══════════ FOOTER ══════════ */
        .footer {
            background: rgba(255,255,255,.95);
            padding: 40px 0;
            margin-top: 60px;
            text-align: center;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }

        .footer p {
            margin: 5px 0;
        }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 768px) {
            .page-hero h1 { font-size: 32px; }
            .section-title { font-size: 24px; }
            nav { width: 100%; justify-content: center; gap: 15px; }
            .content-section { padding: 20px; }
            .team-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ══════════ HEADER ══════════ -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <span class="logo-icon"></span>
                <h1>E-Parking</h1>
            </div>
            <nav>
                <a href="{{ route('welcome') }}">Нүүр</a>
                <a href="{{ route('map') }}">Газрын зураг</a>
                <a href="{{ route('welcome') }}">Зогсоолууд</a>
                <a href="{{ route('bidnii-tuhai') }}" style="color: #667eea; font-weight: 700;">Бидний тухай</a>
            </nav>
            <div class="header-auth">
                @if(Auth::check())
                <div class="user-pill" style="display: flex;">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                        @csrf
                        <button type="submit" class="btn-logout">Гарах ✕</button>
                    </form>
                </div>
                @else
                <a href="{{ route('login') }}" class="btn-login">Нэвтрэх</a>
                @endif
            </div>
        </div>
    </div>
</header>

<!-- ══════════ PAGE HERO ══════════ -->
<section class="page-hero">
    <h1>Бидний тухай</h1>
    <p>E-Parking - Системийн хөгжлийн үйл явц</p>
</section>

<!-- ══════════ MAIN CONTENT ══════════ -->
<div class="container">
    <div class="content-section">
        <!-- COMPANY INFO -->
        <div class="company-info">
            <h2>📋 Бидний зорилго</h2>
            <p>E-Parking системийн зорилго нь авто зогсоолын хүртээмжийг нэмэгдүүлж, хэрэглэгчдэд сул зогсоолыг бодит цаг хугацаанд харах, 
                урьдчилан захиалах, төлбөрөө хялбар хийх боломжийг бүрдүүлэхэд оршино. Мөн хотын түгжрэлийг бууруулж, зогсоол хайх хугацааг багасгах ухаалаг шийдлийг нэвтрүүлэхэд чиглэнэ.
            </p>
            <p>
              E-Parking нь Улаанбаатар хотын 100+ зогсоол, 400+ нийтийн зогсоолын мэдээллийг нэгтгэн, 100+ орчинд ухаалаг зогсоолын 
              шийдлийг нэвтрүүлэх зорилготой. Бид технологид суурилсан шийдлээр хотын зогсоолын асуудлыг шийдэж, нийгэм болон байгальд эерэг нөлөө үзүүлэхийг зорьдог.
            </p>
        </div>

        <!-- GOALS & OBJECTIVES -->
        <div class="goals-section">
            <h2 class="section-title"> Зорилго болон Үр дүнгээс хүлээх</h2>
            <div class="goals-grid">
                <div class="goal-card">
                    <h3>🌟 Зорилго</h3>
                    <p>
                        Улаанбаатарын зогсоолын систем сайжруулах, нийтийн орлуулалт өндөрлөх, 
                        ба машины эзэмшигчдийн сэтгэл ханалт нэмэгдүүлэх.
                    </p>
                </div>
                <div class="goal-card">
                    <h3>🚗 Үндсэн Зорилго</h3>
                    <p>
                        Аюулгүй, хялбар, үр ашигтай паркинг системийг хүргэж, дэлхийн урвуу 
                        паркинг технологиг нэвтрүүлэх явдалд анхаараа төвлөрүүлэх.
                    </p>
                </div>
                <div class="goal-card">
                    <h3>🌍 Нийгмийн Үүрэг</h3>
                    <p>
                        Байгаль орчны ногоон байгууламж ба нийгмийн хөгжлийн төлөө ажиллах, ижил төрлийн бизнес 
                        орчныг дэмжих, ба дахин боломжтой эргэлтийн систем нэвтрүүлэх.
                    </p>
                </div>
            </div>
        </div>

        <!-- TEAM SECTION -->
        <div class="team-section">
            <h2 class="section-title">👥 Манай Баг</h2>
            <div class="team-grid">
                <!-- Team Member 1 -->
                <div class="cv-card">
                    <div class="cv-header">
                        <div class="cv-avatar">👨‍💼</div>
                        <div class="cv-name">Г.Хүрэлтулга</div>
                        <div class="cv-position">ТУЗын дарга</div>
                    </div>
                    <div class="cv-body">
                        <div class="cv-section">
                            <div class="cv-section-title">Ажлын туршлага</div>
                            <div class="cv-item">
                                <div class="cv-item-title">EASY PARKING - Үйл ажиллагаа хариуцсан менежер</div>
                                <div class="cv-item-subtitle">2025-2026</div>
                                <p>Системийн админаар ажилд орон үйл ажиллагаа хариуцсан менежер хүртэл амжилттай ажилласан.</p>
                            </div>
                            <div class="cv-item" style="margin-top: 12px;">
                                <div class="cv-item-title">E-PARKING - ТУЗын дарга</div>
                                <div class="cv-item-subtitle">2026-Одоо</div>
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="cv-section">
                            <div class="cv-section-title">Боловсрол</div>
                            <div class="cv-item">
                                <div class="cv-item-title">ХӨВСГӨЛ АЙМГИЙН МӨРӨН ХОТ 1-Р СУРГУУЛЬ</div>
                                <div class="cv-item-subtitle">Бүрэн дунд 2010-2022</div>
                            </div>
                            <div class="cv-item" style="margin-top: 8px;">
                                <div class="cv-item-title">ХҮРЭЭ МХТДСургууль</div>
                                <div class="cv-item-subtitle">Бакалавр - Мэдээллийн технологи, Харилцаа холбоо 2022-2026</div>
                            </div>
                            
                        </div>
                        <div class="cv-section">
                            <div class="cv-section-title">Ур чадвар</div>
                            <div class="skills">
                                <span class="skill-tag">Удирдлага</span>
                                <span class="skill-tag">Төслийн сахилга</span>
                                <span class="skill-tag">Шинэ санаа</span>
                                <span class="skill-tag">Багийн хамтын ажиллагаа</span>
                                <span class="skill-tag">Стратеги төлөвлөлт</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="cv-card">
                    <div class="cv-header">
                        <div class="cv-avatar">👩‍💻</div>
                        <div class="cv-name">Т.Дэлгэрмөрөн</div>
                        <div class="cv-position">Технологийн дарга</div>
                    </div>
                    <div class="cv-body">
                        <div class="cv-section">
                            <div class="cv-section-title">Ажлын туршлага</div>
                            <div class="cv-item">
                                <div class="cv-item-title">TECH SOLUTIONS LLC - Ахлах технологич</div>
                                <div class="cv-item-subtitle">2024-2026 </div>
                                <p>Системийн хөгжил, архитектур дизайн, үр ашигтай технологийн сонголт.</p>
                            </div>
                            <div class="cv-item" style="margin-top: 12px;">
                                <div class="cv-item-title">E-PARKING - Технологийн дарга</div>
                                <div class="cv-item-subtitle">2026-Одоо</div>
                                <p></p>
                            </div>
                        </div>
                        <div class="cv-section">
                            <div class="cv-section-title">Боловсрол</div>
                            <div class="cv-item">
                                <div class="cv-item-title">НИЙСЛЭЛИЙН ИРЭЭДҮЙ ЦОГЦОЛБОР </div>
                                <div class="cv-item-subtitle">Бүрэн дунд 2010-2022</div>
                            </div>
                           <div class="cv-item" style="margin-top: 8px;">
                                <div class="cv-item-title">ХҮРЭЭ МХТДСургууль</div>
                                <div class="cv-item-subtitle">Бакалавр - Мэдээллийн технологи, Харилцаа холбоо 2022-2026</div>
                            </div>
                        </div>
                        <div class="cv-section">
                            <div class="cv-section-title">Ур чадвар</div>
                            <div class="skills">
                                <span class="skill-tag">WOKWI</span>
                                <span class="skill-tag">TINKERCAD</span>
                                <span class="skill-tag">MySQL</span>
                                <span class="skill-tag">Cloud Services</span>
                                <span class="skill-tag">CISCO</span>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="cv-card">
                    <div class="cv-header">
                        <div class="cv-avatar">👨‍🎨</div>
                        <div class="cv-name">Б.Баасанжаргал</div>
                        <div class="cv-position">Үйл ажиллагаа хариуцсан дарга</div>
                    </div>
                    <div class="cv-body">
                        <div class="cv-section">
                            <div class="cv-section-title">Ажлын туршлага</div>
                            <div class="cv-item">
                                <div class="cv-item-title">MOST PARKING - Суурилуулалтын инженер</div>
                                <div class="cv-item-subtitle">2024-2026</div>
                                <p>.</p>
                            </div>
                            <div class="cv-item" style="margin-top: 12px;">
                                <div class="cv-item-title">E-PARKING - Үйл ажиллагаа хариуцсан дарга</div>
                                <div class="cv-item-subtitle">2026-Одоо</div>
                                <p></p>
                            </div>
                        </div>
                        <div class="cv-section">
                            <div class="cv-section-title">Боловсрол</div>
                            <div class="cv-item">
                                <div class="cv-item-title">НИЙСЛЭЛИЙН 51-Р СУРГУУЛЬ</div>
                                <div class="cv-item-subtitle">Бүрэн дунд 2010-2022</div>
                            </div>
                            <div class="cv-item" style="margin-top: 8px;">
                                <div class="cv-item-title">ХҮРЭЭ МХТДСургууль</div>
                                <div class="cv-item-subtitle">Бакалавр - Мэдээллийн технологи, Харилцаа холбоо 2022-2026</div>
                            </div>
                        </div>
                        <div class="cv-section">
                            <div class="cv-section-title">Ур чадвар</div>
                            <div class="skills">
                                <span class="skill-tag">laravel</span>
                                <span class="skill-tag">Adobe XD</span>
                                <span class="skill-tag">UI Design</span>
                                <span class="skill-tag">UX Research</span>
                                <span class="skill-tag">Prototyping</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════ FOOTER ══════════ -->
<footer class="footer">
    <div class="container">
        <p>© 2024 E-Parking. Бүх эрх хуулиар хамгаалагдсан.</p>
        <p style="margin-top:10px;">Холбоо барих: info@E-Parking.mn | +976 7000-0000</p>
    </div>
</footer>

</body>
</html>

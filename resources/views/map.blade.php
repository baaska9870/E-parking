<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зогсоолын газрын зураг - E-Parking</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            height: 100vh;
            overflow: hidden;
        }

        /* Full-screen map */
        #fullMap {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        /* Top header bar */
        .map-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .map-header h1 {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .map-header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-back {
            background: rgba(255,255,255,0.2);
            border: 2px solid white;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        /* Search bar */
        .map-search {
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 300px;
        }

        .map-search input {
            border: none;
            outline: none;
            font-size: 14px;
            flex: 1;
            background: transparent;
        }

        .map-search button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .map-search button:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }

        /* Map margin for header */
        #fullMap {
            margin-top: 70px;
            height: calc(100vh - 70px);
        }

        /* Leaflet popup adjustments */
        .leaflet-popup-content {
            font-family: Arial, sans-serif;
        }

        .leaflet-popup-content h3 {
            margin: 0 0 10px;
            color: #667eea;
            font-size: 16px;
        }

        .leaflet-popup-content p {
            margin: 5px 0;
            color: #666;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .map-header {
                flex-direction: column;
                gap: 10px;
                padding: 10px 15px;
            }

            .map-search {
                min-width: auto;
                width: 100%;
            }

            #fullMap {
                margin-top: 120px;
                height: calc(100vh - 120px);
            }

            .map-header h1 {
                font-size: 18px;
            }

            .btn-back {
                padding: 8px 15px;
                font-size: 12px;
            }
        }

        /* User info */
        .map-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 20px;
        }

        .user-mini-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .map-user-info span {
            color: white;
            font-size: 13px;
            font-weight: 500;
        }

        /* Legend */
        .map-legend {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 900;
            font-size: 13px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .legend-item:last-child {
            margin-bottom: 0;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .legend-item.high .legend-color { background: #16a34a; }
        .legend-item.medium .legend-color { background: #999f00; }
        .legend-item.low .legend-color { background: #ff0000; }
        .legend-item.full .legend-color { background: #670000; }
    </style>
</head>
<body>

<!-- Header -->
<div class="map-header">
    <h1> Зогсоолын газрын зураг</h1>
    <div class="map-search">
        <input type="text" id="searchInput" placeholder="Зогсоол эсвэл байршил хайх...">
        <button onclick="searchParking()">🔍</button>
    </div>
    <div class="map-header-actions">
        @if(Auth::check())
            <div class="map-user-info">
                <div class="user-mini-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <span>{{ Auth::user()->name }}</span>
            </div>
        @endif
        <a href="{{ route('welcome') }}" class="btn-back">← Буцах</a>
    </div>
</div>

<!-- Full-screen Map -->
<div id="fullMap"></div>

<!-- Legend -->
<div class="map-legend">
    <div style="font-weight: 600; margin-bottom: 10px; color: #333;">Зогсоолын байдал</div>
    <div class="legend-item high">
        <div class="legend-color"></div>
        <span>Маш элбэг</span>
    </div>
    <div class="legend-item medium">
        <div class="legend-color"></div>
        <span>Дунд зэргийн</span>
    </div>
    <div class="legend-item low">
        <div class="legend-color"></div>
        <span>Цөөн үлдсэн</span>
    </div>
    <div class="legend-item full">
        <div class="legend-color"></div>
        <span>Дүүрсэн</span>
    </div>
</div>

<!-- Parking data -->
<script>
    const parkings = [
    { name: 'ХҮРЭЭ КОЛЛЕЖ', location: ' БГД ', lat: 47.92645, lng: 106.88454, capacity: 50, available: 45, price: '2,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'ТАЛБАЙН УРД ЗОГСООЛ', location: ' СБД ', lat: 47.91787, lng: 106.91774, capacity: 50, available: 45, price: '2,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'БӨМБӨГӨР ХУДАЛДААНЫ ТӨВ', location: 'СБД', lat: 47.91967, lng: 106.89942, capacity: 100, available: 78, price: '2,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'ТБД АНДУУД BSB LIFESTYLE', location: '', lat: 47.91428, lng: 106.88426, capacity: 35, available: 12, price: '2,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'GRAND PLAZA', location: 'БГД', lat: 47.91407, lng: 106.89039, capacity: 56, available: 45, price: '2,000₮/цаг ', type: 'Нийтийн', planImage: '' },
    { name: 'MAX MALL', location: 'БГД', lat: 47.91967, lng: 106.89942, capacity: 50, available: 28, price: '2,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'СПОРТЫН ТӨВ ОРДОН', location: 'СБД', lat: 47.91967, lng: 106.89942, capacity: 80, available: 45, price: '2,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'УЛСЫН ИХ ДЭЛГҮҮР ЗОГСООЛ', location: 'СБД', lat: 47.91653,  lng: 106.90644, capacity: 60, available: 12, price: '1,500₮/цаг', type: 'Худалдааны төв', planImage: '' },
    { name: 'НАРАНТУУЛ ЗАХ ЗОГСООЛ', location: 'БЗД', lat: 47.90913, lng: 106.94828, capacity: 300, available: 246, price: '1,000₮/цаг', type: 'Захын', planImage: '' },    
    { name: 'Хан-Уул зогсоол', location: 'Хан-Уул дүүрэг', lat: 47.9100, lng: 106.9050, capacity: 120, available: 88, price: '1,200₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: 'БАРИЛГАЧИДЫН ТАЛБАЙ', location: 'СБД', lat: 47.92011, lng: 106.90856, capacity: 60, available: 43, price: '1,000₮/цаг', type: 'Захын', planImage: '' },    
    { name: 'ТӨМӨР ЗАМЫН ЗОГСООЛ', location: 'БГД', lat: 47.90895, lng: 106.88391, capacity: 70, available: 35, price: '1,000₮/цаг', type: 'Захын', planImage: '' },    
    { name: '3-Р ЭМНЭЛЭГИЙН ЗОГСООЛ', location: 'БГД', lat: 47.91347, lng: 106.85724, capacity: 80, available: 74, price: '1,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: '2-Р ЭМНЭЛЭГИЙН ЗОГСООЛ', location: 'БЗД', lat: 47.91924, lng: 106.93729, capacity: 80, available: 12, price: '1,000₮/цаг', type: 'Нийтийн', planImage: '' },
    { name: '1-Р ЭМНЭЛЭГИЙН ЗОГСООЛ', location: 'БЗД', lat: 47.91540, lng: 106.92474, capacity: 80, available: 23, price: '1,000₮/цаг', type: 'Нийтийн', planImage: '' },
    
    ];

    // Initialize map
    let map;
    function initFullMap() {
        map = L.map('fullMap').setView([47.9184, 106.9177], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add user location tracking
        map.locate({setView: false, maxZoom: 16});
        
        map.on('locationfound', function(e) {
            const radius = e.accuracy / 2;
            
            if (window.userLocationMarker) {
                map.removeLayer(window.userLocationMarker);
            }
            if (window.userLocationCircle) {
                map.removeLayer(window.userLocationCircle);
            }
            
            window.userLocationMarker = L.marker(e.latlng, {
                icon: L.divIcon({
                    html: `<div style="background:#2563EB;width:20px;height:20px;border-radius:50%;border:3px solid white;box-shadow:0 0 10px rgba(37, 99, 235, 0.6);display:flex;align-items:center;justify-content:center;"><div style="background:white;width:6px;height:6px;border-radius:50%;"></div></div>`,
                    className: '', iconSize: [20, 20], iconAnchor: [10, 10]
                })
            }).addTo(map);
            
            window.userLocationCircle = L.circle(e.latlng, radius, {
                color: '#2563EB',
                fillColor: '#2563EB',
                fillOpacity: 0.1,
                weight: 1,
                dashArray: '5, 5'
            }).addTo(map);
        });

        // Add parking markers
        parkings.forEach(parking => {
            const status = getStatus(parking.available, parking.capacity);
            let color;

            if (status === 'high') {
                color = '#16a34a';
            } else if (status === 'medium') {
                color = '#999f00';
            } else if (status === 'low') {
                color = '#ff0000';
            } else {
                color = '#670000';
            }

            const marker = L.marker([parking.lat, parking.lng], {
                icon: L.divIcon({
                    html: `<div style="background:${color};width:30px;height:30px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:16px;">P</div>`,
                    className: '', iconSize: [30, 30], iconAnchor: [15, 15]
                })
            }).addTo(map);

            marker.bindPopup(`
                <div style="min-width:250px;">
                    <h3>${parking.name}</h3>
                    <p><strong>📍</strong> ${parking.location}</p>
                    <p><strong>🏢</strong> ${parking.type}</p>
                    <p><strong>🚗</strong> ${parking.available}/${parking.capacity} суудал</p>
                    <p><strong>💵</strong> ${parking.price}</p>
                    <p><span style="background:${color};color:white;padding:5px 10px;border-radius:15px;font-size:12px;">${getStatusText(status)}</span></p>
                    ${parking.planImage ? `<hr style="margin: 10px 0; border: none; border-top: 1px solid #e0e0e0;">
                    <div style="margin-top: 10px;">
                        <p style="font-weight: 600; font-size: 13px; margin-bottom: 8px;">📐 Зогсоолын төлөвлөгөө:</p>
                        <img src="${parking.planImage}" alt="${parking.name} план" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </div>` : `<hr style="margin: 10px 0; border: none; border-top: 1px solid #e0e0e0;">
                    <div style="margin-top: 10px; padding: 8px; background: #f5f5f5; border-radius: 6px; font-size: 12px; color: #666;">
                        <p style="font-weight: 600; margin-bottom: 5px;">📐 Төлөвлөгөө:</p>
                        <p>Төлөвлөгөө нэмэхийн тулд администратортай холбоо барина уу.</p>
                    </div>`}
                </div>
            `);
        });
    }

    function getStatus(a, c) {
        const p = (a / c) * 100;
        if (p > 100) return 'high';
        if (p > 40) return 'medium';
        if (p > 10) return 'low';
        return 'full';
    }

    function getStatusText(s) {
        if (s === 'high') return 'Маш элбэг';
        if (s === 'medium') return 'Дунд зэргийн';
        if (s === 'low') return 'Цөөн үлдсэн';
        return 'Зогсоол дүүрсэн';
    }

    function searchParking() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        const found = parkings.find(p => p.name.toLowerCase().includes(q) || p.location.toLowerCase().includes(q));
        if (found) {
            map.setView([found.lat, found.lng], 15);
        } else {
            alert('Зогсоол олдсонгүй');
        }
    }

    document.getElementById('searchInput').addEventListener('keypress', e => {
        if (e.key === 'Enter') searchParking();
    });

    window.onload = function() {
        initFullMap();
    };
</script>

</body>
</html>

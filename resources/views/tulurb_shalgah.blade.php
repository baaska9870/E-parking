<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Төлбөр шалгах</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f1f5f9;
            color: #111827;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            width: 100%;
            max-width: 720px;
            background: #fff;
            padding: 32px;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.12);
        }
        h1 {
            margin-bottom: 16px;
            font-size: 32px;
            color: #1f2937;
        }
        p {
            line-height: 1.8;
            color: #4b5563;
            margin-bottom: 24px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 15px;
            color: #111827;
        }
        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s ease;
            margin-right: 12px;
        }
        .btn:hover {
            background: #1d4ed8;
        }
        .btn-secondary {
            background: #e2e8f0;
            color: #1f2937;
        }
        .btn-secondary:hover {
            background: #cbd5e1;
        }
        .result-window {
            margin-top: 26px;
            padding: 22px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            display: none;
        }
        .result-window.visible {
            display: block;
        }
        .result-window h2 {
            margin-top: 0;
            font-size: 22px;
            color: #0f172a;
        }
        .result-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px 24px;
            align-items: center;
            margin-bottom: 12px;
        }
        .result-label {
            color: #475569;
            font-weight: 600;
        }
        .result-value {
            color: #111827;
            font-weight: 700;
        }
        .status-pill {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            background: #d1fae5;
            color: #166534;
        }
        .error {
            color: #b91c1c;
            margin-top: 12px;
            font-weight: 600;
        }
        a {
            display: inline-block;
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            margin-top: 16px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Төлбөр шалгах</h1>
        <p>Зогсоолын төлбөр шалгахын тулд таны тээврийн хэрэгслийн дугаарыг оруулна уу.</p>

        <form id="paymentCheckForm">
            <div class="form-group">
                <label for="vehicleNumber">Тээврийн хэрэгслийн дугаар</label>
                <input type="text" id="vehicleNumber" name="vehicleNumber" placeholder="Жишээ: УАА 1234" required>
            </div>
            <button type="submit" class="btn">Шалгах</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('welcome') }}'">Нүүр рүү буцах</button>
            <div id="formError" class="error" style="display:none;">Бүх талбаруудыг зөв бөглөнө үү.</div>
        </form>

        <div id="resultWindow" class="result-window" role="status" aria-live="polite">
            <h2>Төлбөрийн харах цонх</h2>
            <div class="result-row">
                <div class="result-label">Тээврийн хэрэгслийн дугаар:</div>
                <div class="result-value" id="resultVehicle">-</div>
            </div>
            <div class="result-row">
                <div class="result-label">Төлбөрийн төлөв:</div>
                <div class="status-pill" id="resultStatus">Шалгаж байна...</div>
            </div>
            <p>Үр дүнг шууд харж, төлбөрийн мэдээллийг баталгаажуулна.</p>
        </div>
    </div>

    <script>
        document.getElementById('paymentCheckForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var vehicle = document.getElementById('vehicleNumber').value.trim();
            var error = document.getElementById('formError');

            if (!vehicle) {
                error.style.display = 'block';
                return;
            }

            error.style.display = 'none';
            document.getElementById('resultVehicle').textContent = vehicle;
            document.getElementById('resultSerial').textContent = serial;
            document.getElementById('resultStatus').textContent = 'Төлбөр төлөгдсөн эсэхийг шалгаж байна';
            document.getElementById('resultStatus').style.background = '#fbbf24';
            document.getElementById('resultStatus').style.color = '#92400e';
            document.getElementById('resultWindow').classList.add('visible');

            setTimeout(function() {
                document.getElementById('resultStatus').textContent = 'Төлбөр төлөгдсөн';
                document.getElementById('resultStatus').style.background = '#d1fae5';
                document.getElementById('resultStatus').style.color = '#166534';
            }, 1200);
        });
    </script>
</body>
</html>

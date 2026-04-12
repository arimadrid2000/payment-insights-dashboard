<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Payment Insights</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">💳 Dashboard de Pagos</h1>

        <div class="bg-white p-4 rounded shadow mb-6 flex justify-between items-center">
            <span>Estado del Servidor (Node.js):</span>
            <span class="px-3 py-1 rounded-full text-white {{ ($apiHealth['status'] ?? '') == 'up' ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $apiHealth['status'] ?? 'Offline' }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Nuevo Pago</h2>
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" required>
                    <input type="number" name="amount" placeholder="Monto" class="w-full mb-3 p-2 border rounded" required>
                    <input type="text" name="cardNumber" placeholder="Tarjeta (16 dígitos)" class="w-full mb-3 p-2 border rounded" required>
                    <input type="text" name="cvv" placeholder="CVV" class="w-full mb-3 p-2 border rounded" required>
                    <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Procesar Pago</button>
                </form>
                @if($errors->any())
                    <p class="mt-3 text-red-500">{{ $errors->first() }}</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Últimas Transacciones</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">ID</th>
                            <th>Monto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                        <tr class="border-b">
                            <td class="py-2 text-sm text-gray-600">{{ $tx->external_id }}</td>
                            <td>${{ $tx->amount }}</td>
                            <td><span class="text-green-600 font-bold uppercase">{{ $tx->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

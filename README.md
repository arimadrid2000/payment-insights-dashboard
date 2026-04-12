# Payment Insights Dashboard 📊

Un panel administrativo desarrollado con **Laravel 11** que funciona como el orquestador de una suite de pagos. Este sistema consume microservicios externos, persiste datos de transacciones y ofrece una interfaz de monitoreo en tiempo real.

## 🌟 Características Senior

- **Service Pattern Architecture:** Implementación de servicios dedicados para el consumo de APIs externas, manteniendo los controladores limpios y enfocados.
- **Integración de Microservicios:** Conexión fluida con un Gateway de Pagos externo (Node.js/TypeScript) mediante el cliente HTTP de Laravel.
- **Mass Assignment Protection:** Uso estricto de seguridad en modelos para prevenir vulnerabilidades de asignación masiva.
- **Observabilidad:** Monitoreo integrado del estado de salud (Health Check) del servidor de procesamiento.
- **Tailwind UI:** Interfaz moderna y responsive diseñada para la gestión de datos financieros.

## 🛠️ Stack Tecnológico

* **Framework:** Laravel 11
* **Lenguaje:** PHP 8.2+
* **Base de Datos:** SQLite / MySQL
* **Estilos:** Tailwind CSS
* **Consumo API:** Guzzle / HTTP Client

## ⚙️ Arquitectura de Integración

El Dashboard no procesa los pagos directamente; actúa como un cliente inteligente.



1.  **UI:** El usuario ingresa los datos de la tarjeta.
2.  **Service Layer:** El `PaymentApiService` formatea y envía el payload a la API en Render.
3.  **Persistence:** Si la respuesta es exitosa, los datos se normalizan y se guardan localmente para análisis histórico.

## 🚀 Instalación y Configuración

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/arimadrid2000/payment-insights-dashboard.git](https://github.com/arimadrid2000/payment-insights-dashboard.git)
    cd payment-insights-dashboard
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Configurar Variables de Entorno:**
    Copia el archivo de ejemplo y configura la URL de tu API de Node.js:
    ```bash
    cp .env.example .env
    ```
    Edita el `.env`:
    ```env
    PAYMENT_GATEWAY_URL=[https://tu-api-en-render.com](https://tu-api-en-render.com)
    ```

4.  **Ejecutar Migraciones:**
    ```bash
    php artisan migrate
    ```

5.  **Iniciar Servidor:**
    ```bash
    php artisan serve
    ```

## 🔌 Conectividad

Este proyecto consume los endpoints de la [Payment Gateway API](https://github.com/arimadrid2000/payment-gateway-api):
- `POST /api/v1/payments`: Procesamiento seguro.
- `GET /api/v1/payments/health`: Monitoreo de latencia y estado.

---
**Desarrollado por [Arianna Madrid](https://github.com/arimadrid2000)**

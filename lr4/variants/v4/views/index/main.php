<div class="page-home">
    <h1>Піцерія</h1>
    <p class="page-home__subtitle">Ласкаво просимо до піцерії!</p>

    <div class="card-grid">
        <div class="card">
            <h3 class="card__title">Популярні начинки до піцци</h3>
            <p class="card__text">
                Гриби, салямі, помідори, олівки.
            </p>
        </div>

        <div class="card">
            <h3 class="card__title">Реєстрація</h3>
            <p class="card__text">
                Зареєструйтесь, щоб зберігати улюблені начинки до піцци,
                залишати коментарі та ділитися власними стравами.
            </p>
            <a href="index.php?route=regform/form" class="btn btn--small">Зареєструватися</a>
        </div>

        <div class="card">
            <h3 class="card__title">Меню піццерії та замовлення</h3>
            <p class="card__text">
                Технічна сторінка для перегляду меню піцерії.
            </p>
            <a href="index.php?route=reqview/showrequest" class="btn btn--small">Перейти</a>
        </div>

        <div class="card">
            <h3 class="card__title">Налаштування</h3>
            <p class="card__text">
                Оберіть колір фону сайту та налаштуйте персональне привітання.
            </p>
            <a href="index.php?route=settings/color" class="btn btn--small">Налаштувати</a>
        </div>
    </div>

    <div class="info-block">
        <h2>Структура MVC</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Клас</th>
                    <th>Призначення</th>
                </tr>
            </thead>
            <tbody>
                <tr><td><code>Application</code></td><td>Завантаження додатку, виклик контролера</td></tr>
                <tr><td><code>Router</code></td><td>Розбір URL &rarr; контролер + дія</td></tr>
                <tr><td><code>Request</code></td><td>Обгортка для <code>$_GET</code> / <code>$_POST</code></td></tr>
                <tr><td><code>Controller</code></td><td>Базовий клас контролера</td></tr>
                <tr><td><code>PageController</code></td><td>Контролер для сторінок</td></tr>
                <tr><td><code>View</code></td><td>Базовий клас для відображення</td></tr>
                <tr><td><code>PageView</code></td><td>Шаблон сторінки з layout</td></tr>
            </tbody>
        </table>
    </div>
</div>

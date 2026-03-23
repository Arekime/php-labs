<?php
$errors = $errors ?? [];
$old = $old ?? [];
?>

<h1>Реєстрація на кулінарному блозі</h1>
<p>Створіть акаунт, щоб зберігати рецепти та залишати коментарі.</p>

<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <strong>Помилки при заповненні форми:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?route=regform/form" class="form">
    <div class="form__group">
        <label for="login" class="form__label">Прізвище</label>
        <input type="text" id="login" name="login"
               class="form__input<?= isset($errors['login']) ? ' form__input--error' : '' ?>"
               value="<?= htmlspecialchars($old['login'] ?? '') ?>"
               placeholder="Ваше прізвище (без пробілів, без цифр, мін. 5 символів)">
        <?php if (isset($errors['login'])): ?>
            <span class="form__error"><?= htmlspecialchars($errors['login']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form__row">
        <div class="form__group">
            <label for="password" class="form__label">Ім'я</label>
            <input type="text" id="password" name="password"
                   class="form__input<?= isset($errors['password']) ? ' form__input--error' : '' ?>"
                   value="<?= htmlspecialchars($old['password'] ?? '') ?>"
                   placeholder="Ваше ім'я (без пробілів, без цифр, мін. 2 символи)">
            <?php if (isset($errors['password'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['password']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form__group">
            <label for="password_confirm" class="form__label">По батькові</label>
            <input type="text" id="password_confirm" name="password_confirm"
                   class="form__input<?= isset($errors['password_confirm']) ? ' form__input--error' : '' ?>"
                   value="<?= htmlspecialchars($old['password_confirm'] ?? '') ?>"
                   placeholder="Ваше по батькові (без пробілів, без цифр, мін. 2 символи)">
            <?php if (isset($errors['password_confirm'])): ?>
                <span class="form__error"><?= htmlspecialchars($errors['password_confirm']) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form__group">
        <label for="about" class="form__label">Улюбленні начинки</label>
        <textarea id="about" name="about" class="form__textarea" rows="4"
                    placeholder="Розкажіть про свої улюбленні начинки для піци"><?= htmlspecialchars($old['about'] ?? '') ?></textarea>
                    <input type="checkbox" id="pizza_toppings_1" name="pizza_toppings[]" value="pepperoni">
                    <label for="pizza_toppings_1">Пеппероні</label>
                    <input type="checkbox" id="pizza_toppings_2" name="pizza_toppings[]" value="mushrooms">
                    <label for="pizza_toppings_2">Моцарела</label>
                    <input type="checkbox" id="pizza_toppings_3" name="pizza_toppings[]" value="onions">
                    <label for="pizza_toppings_3">Гриби</label>
                    <input type="checkbox" id="pizza_toppings_4" name="pizza_toppings[]" value="olives">
                    <label for="pizza_toppings_4">Оливки</label>
                    <input type="checkbox" id="pizza_toppings_5" name="pizza_toppings[]" value="ham">
                    <label for="pizza_toppings_5">Шинка</label>
                    <input type="checkbox" id="pizza_toppings_6" name="pizza_toppings[]" value="pineapples">
                    <label for="pizza_toppings_6">Ананаси</label>
                    <input type="checkbox" id="pizza_toppings_7" name="pizza_toppings[]" value="arugula">
                    <label for="pizza_toppings_7">Рукола</label>
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Зареєструватися</button>
        <button type="reset" class="btn btn--secondary">Очистити</button>
    </div>
</form>

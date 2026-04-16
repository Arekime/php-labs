<?php
$getParams = $getParams ?? [];
$postParams = $postParams ?? [];
$method = $method ?? 'GET';
$selectedPizzas = $selectedPizzas ?? [];
$pizzaOptions = $pizzaOptions ?? [];
?>

<h1>Меню піццерії</h1>

<div class="reqview-grid">
    <div class="reqview-section">
        <h2>Меню</h2>
        <p></p>
        <form method="POST" action="index.php?route=reqview/showrequest&source=form" class="form">
            <div class="form__group">
                <input type="checkbox" id="check1" name="option[]" value="1">
<label for="check1">Pepperoni</label><br>
<div style="margin-left: 25px; color: gray; font-size: 0.9em;">
            включає томатний соус, велику кількість сиру моцарела та гостру ковбасу пепероні (або чоризо), нарізану тонкими скибочками.
        </div>
                <input type="checkbox" id="check2" name="option[]" value="2">
<label for="check2">Margherita</label><br>
<div style="margin-left: 25px; color: gray; font-size: 0.9em;">
            хрустке тісто, томатний соус (найчастіше з помідорів Сан-Марцано), сир моцарела (ідеально — Mozzarella di Bufala), свіжий базилік та оливкова олія
        </div>
                <input type="checkbox" id="check3" name="option[]" value="3">
<label for="check3">Hawaiian</label><br>
<div style="margin-left: 25px; color: gray; font-size: 0.9em;">
            ананаси (консервовані або свіжі), шинка (або куряче філе) та сир моцарелла на основі з томатного або білого соусу
        </div>
                <input type="checkbox" id="check4" name="option[]" value="4">
<label for="check4">Four Cheese</label><br>
<div style="margin-left: 25px; color: gray; font-size: 0.9em;">
            складається з поєднання чотирьох різних видів сиру — м'якого, твердого, пікантного з пліснявою та ароматного
        </div>
                <input type="checkbox" id="check5" name="option[]" value="5">
<label for="check5">Veggie</label><br>
<div style="margin-left: 25px; color: gray; font-size: 0.9em;">
            поєднання свіжих або запечених овочів, зелені та сиру
        </div>
            </div>
            <button type="submit" class="btn">Оформити замовлення</button>
        </form>

        <h3>GET-параметри в URL</h3>
        <p>Додайте параметри до URL, наприклад:</p>
        <code class="code-block">index.php?route=reqview/showrequest&recipe=Borshch&servings=4</code>
    </div>

    <div class="reqview-section">
        <h2>Замовлення</h2>
        
        <?php if (empty($selectedPizzas)): ?>
            <p class="text-muted">Замовлень немає. Виберіть піцци зліва та натисніть "Оформити замовлення".</p>
        <?php else: ?>
            <div class="order-summary">
                <h3>Ваше замовлення:</h3>
                <ul class="order-list">
                    <?php foreach ($selectedPizzas as $pizza): ?>
                        <li class="order-item">✓ <?= htmlspecialchars($pizza) ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="order-total">
                    <p><strong>Всього позицій:</strong> <?= count($selectedPizzas) ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

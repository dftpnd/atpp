<h1>
  Чтобы что то найти или загрузить выберите предмет
</h1>
<?php
$even = 'even';
?>
<?php if (isset($predmets)): ?>
  <?php if (!empty($predmets)): ?>
    <?php foreach ($predmets as $predmet): ?>
      <?php if ($even == 'even'): ?>
        <?php $even = ''; ?>
      <?php else: ?>
        <?php $even = 'even'; ?>
      <?php endif; ?>
      <div class="predmetfile <?php echo $even; ?>">
        <?php echo CHtml::link($predmet->name, Yii::app()->urlManager->createUrl('user/predmetfile/' . $predmet->id), array('class' => 'classic')); ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
<?php endif; ?>
<div class="context resume__emptyblock aspx_4">
  <span>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"  width="100%" height="100%" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
      <g id="Layer_2" >
      </g>
      <g id="Layer_1" >
        <g>
          <path feel="#ffffff" d="M150,0c-27.614,0-50,22.386-50,50s22.386,50,50,50s50-22.386,50-50S177.614,0,150,0z M150,95c-24.813,0-45-20.187-45-45    c0-24.813,20.187-45,45-45c24.813,0,45,20.187,45,45C195,74.813,174.813,95,150,95z"/>
          <path feel="#ffffff"  d="M50,0C22.386,0,0,22.386,0,50s22.386,50,50,50s50-22.386,50-50S77.614,0,50,0z M50,95C25.187,95,5,74.813,5,50    C5,25.187,25.187,5,50,5c24.813,0,45,20.187,45,45C95,74.813,74.813,95,50,95z"/>
          <circle feel="#ffffff"  cx="22.5" cy="37.5" r="2.5"/>
          <circle feel="#ffffff"  cx="77.5" cy="37.5" r="2.5"/>
          <path feel="#ffffff"  d="M77.5,47.5c-1.381,0-2.5,1.119-2.5,2.5c0,13.785-11.215,25-25,25S25,63.785,25,50c0-1.381-1.119-2.5-2.5-2.5    S20,48.619,20,50c0,16.542,13.458,30,30,30s30-13.458,30-30C80,48.619,78.881,47.5,77.5,47.5z"/>
          <path feel="#ffffff"  d="M100-50c0-27.614-22.386-50-50-50S0-77.614,0-50S22.386,0,50,0S100-22.386,100-50z M50-5C25.187-5,5-25.187,5-50    c0-24.813,20.187-45,45-45c24.813,0,45,20.187,45,45C95-25.187,74.813-5,50-5z"/>
          <path feel="#ffffff"  d="M150,0c27.614,0,50-22.386,50-50s-22.386-50-50-50s-50,22.386-50,50S122.386,0,150,0z M150-95c24.813,0,45,20.187,45,45    c0,24.813-20.187,45-45,45c-24.813,0-45-20.187-45-45C105-74.813,125.187-95,150-95z"/>
        </g>
      </g>
    </svg>
  </span>
  <div>
    Внимание! Этот раздел могут просматривать только сдуденты.<br/>
    Сюда вы можете загружать любые материалы:
    <ul>
      <li>
        Шпаргалки
      </li>
      <li>
        Бомбы
      </li>
      <li>
        Электронные лекции
      </li>
      <li>
        Любые расчетные материалы
      </li>
    </ul>
    <div class="pomniter">
      Помниете, любая информация может помочь студентам младших курсов.
    </div>
  </div>
</div>
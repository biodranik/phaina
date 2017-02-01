<footer class="footer">
  <div class="footer__container">
    <ul class="footer-nav">
      <?php foreach (MainMenu() as $m) : ?>
        <li class="footer-nav__item">
          <a class="footer__link" href="<?= $m->url ?>"><?= $m->title ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
    <p class="footer__copyright">&copy; 2017 VibroBox OÜ</p>
  </div>
</footer>

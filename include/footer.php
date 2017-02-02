<footer class="footer">
  <div class="footer__container">
    <ul class="footer__nav">
      <?php foreach (MainMenu() as $m) : ?>
      <li class="footer__nav-item">
        <a class="footer__link" href="<?= $m->url ?>"><?= $m->title ?></a>
      </li>
      <?php endforeach; ?>
    </ul>
    <p class="footer__copyright">© 2017 VibroBox OÜ</p>
  </div>
</footer>

<footer class="footer">
  <ul class="footer__nav">
    <?php foreach (MainMenu() as $m) : ?>
    <li class="footer__nav-item">
      <a class="footer__link" href="<?= $m->url ?>"><?= $m->title ?></a>
    </li>
    <?php endforeach; ?>
    <li class="footer__nav-item footer__nav-item--login">
      <a class="footer__link footer__link--login" href="<?= DEMO_URL ?>"><?= T('loginButton') ?></a>
    </li>
  </ul>
  <p class="footer__copyright">© 2017 VibroBox OÜ</p>
</footer>

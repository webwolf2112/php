import { PhpPage } from './app.po';

describe('php App', function() {
  let page: PhpPage;

  beforeEach(() => {
    page = new PhpPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});

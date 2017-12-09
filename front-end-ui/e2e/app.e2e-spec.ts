import { FrontEndUiPage } from './app.po';

describe('front-end-ui App', function() {
  let page: FrontEndUiPage;

  beforeEach(() => {
    page = new FrontEndUiPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});

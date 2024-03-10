/**
 * [注意]レクチャーをプルダウンで選択すると、<head>タグにそのレクチャーでimport "Example.css"のように読み込んだスタイルが挿入されます。このスタイルはプルダウンを切り替えても残りつづけるため、まだcssを記述していないのにスタイルが適用されていると感じた場合にはブラウザを更新してください。
 */

import "./Example.css";
const Example = () => {
  return (
      <div className="component">
          <h1>Cute Cat</h1>
          <div>
              <img src="https://i.imgur.com/O3EIPHpb.jpg"></img>
              <img src="https://i.imgur.com/O3EIPHpb.jpg"></img>
          </div>
          <h3>Hello Component</h3>
      </div>
  );
};

export default Example;

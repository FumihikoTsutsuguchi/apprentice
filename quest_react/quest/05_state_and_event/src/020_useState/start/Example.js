import { useState } from "react";

//eventLisnerの練習
// const Example = () => {
//   let [val, setVal] = useState();
//   return (
//     <>
//       <input
//       type="text"
//       onChange={(e) => {
//         setVal(e.target.value)
//       }} /> = {val}
//     </>
//   );
// };

// export default Example;

//[QUEST10]1. state の追加
// const CounterApp = () => {
//   let stateAndSetter = useState(0);
//   const count = stateAndSetter[0]; // 現在の状態
//   const setCount = stateAndSetter[1]; // 更新関数
//   return (
//     <>
//       <div>
//         <h2>カウンターアプリ</h2>
//         <h1>カウンター: {count}</h1>
//         <button
//           type="button"
//           onClick={() => setCount(prevCount => prevCount + 1)}
//         >増加</button>
//         <button
//           type="button"
//           onClick={() => setCount(prevCount => prevCount - 1)}
//         >減少</button>
//       </div>
//     </>
//   );
// };
// export default CounterApp;

// [QUEST10]4. 複数回のstateの更新をキューに入れる
// const Example = () => {
//   const [count, setCount] = useState(0);
//   const countUp = () => {
//     setCount(count + 1);
//     setCount(prevState => prevState + 1);
//     console.log(count);
//   }
//   const countDown = () => {
//     setCount(count - 1);
//   }
//   return (
//     <>
//       <p>現在のカウント数：{count}</p>
//       <button
//       onClick={countUp}
//       >+</button>
//       <button
//       onClick={countDown}
//       >-</button>
//     </>
//   );
// }
// export default Example;

// [QUEST10]5. state内のオブジェクトの更新

// export default function UserInfoApp() {
//   const [userInfo, setUserInfo] = useState({ name: '大介', age: 25 });

//   console.log(userInfo);

//   function updateName() {
//     console.log(userInfo.name);
//     setUserInfo({name: '太一', age: 25});
//   }

//   return (
//     <div>
//       <h2>ユーザー情報アプリ</h2>
//       <p>名前: {userInfo.name}</p>
//       <p>年齢: {userInfo.age}</p>
//       <button onClick={updateName}>名前を太一に変更</button>
//     </div>
//   );
// }

// [QUEST10]6. state内の配列の更新
export default function UserInfoApp() {
  const [userInfo, setUserInfo] = useState({ name: '大介', age: 25 });
  const [hobbies, setHobbies] = useState(['読書', '映画鑑賞']);

  function updateName() {
    // これはReactのベストプラクティスに反する更新方法
    // userInfo.name = '太一';
    // setUserInfo(userInfo);
    setUserInfo({name: '太一', age: 25});
  }

  function addHobby() {
    // 不正な更新方法：配列を直接変更
    // hobbies.push('新しい趣味');
    setHobbies(['テニス', '園芸']);
  }

  return (
    <div>
      <div>
        <h2>ユーザー情報アプリ</h2>
        <p>名前: {userInfo.name}</p>
        <p>年齢: {userInfo.age}</p>
        <button onClick={updateName}>名前を太一に変更</button>
      </div>
      <div>
        <h3>趣味</h3>
        <ul>
          {hobbies.map((hobby, index) => (
              <li key={index}>{hobby}</li>
          ))}
        </ul>
        <button onClick={addHobby}>趣味を追加（不正な方法）</button>
      </div>
    </div>
  );
}
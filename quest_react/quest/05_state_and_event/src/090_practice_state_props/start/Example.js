import { useState } from "react";

const Example = () => {
const [count, setCount] =  useState(0);
  return (
    <>
      <h3>練習問題</h3>
        <CountResult title="カウント" count={count}/>
        <CountUpdate setCount={setCount} />
    </>
  );
};
const CountResult = ({title, count}) => <h3>{title}:{count}</h3>

const CountUpdate = ({setCount}) => {
  const countUp = () => {
    setCount(prev => prev + 1 )
  };
  const countDown = () => {
    setCount(prev => prev - 1 )
  };
  return (
    <>
      <button onClick={countUp}>+</button>
      <button onClick={countDown}>-</button>
    </>
  );
};

export default Example;

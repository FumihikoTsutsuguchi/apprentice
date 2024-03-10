import "./Child.css";
import { List } from "./List";
import { Cat } from "./Cat";

const Child = () => {
    return (
        <div className="component">
            <h1>Cute Cat</h1>
            <Cat border="border" />
            <Cat />
            <h3>Hello Component</h3>
            <List />
        </div>
    );
};

export default Child;

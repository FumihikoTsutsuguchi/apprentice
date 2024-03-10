// import Child from "./component/Child";
import {Cat} from "./component/Cat";

import "./component/Child.css";

const Card = ({ children }) => {
    return (
        <div className="card">
            { children }
        </div>
    );
}

const CatList = () => {
    return (
        <Card>
            <h1>Cute Cat</h1>
            <Cat
                size={ 150 }
            />
            <Cat
                size={ 150 }
            />
        </Card>
    );
};

export default CatList;

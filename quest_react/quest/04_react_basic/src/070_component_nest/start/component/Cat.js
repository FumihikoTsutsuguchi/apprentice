const Cat = ({ size = 200 }) => {
    return (
        <img
            className="cat"
            src="https://i.imgur.com/O3EIPHpb.jpg"
            alt="猫の画像"
            width={size}
            height={size}
        />
    );
};

export { Cat };

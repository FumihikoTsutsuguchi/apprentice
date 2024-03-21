const Button = ({ type = 'submit', className, ...props }) => (
    <button
        type={type}
        className={`${className} btn btn-lg btn-primary pull-xs-right`}
        {...props}
    />
)

export default Button

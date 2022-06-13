import React from "react"
import PropTypes from "prop-types"

import ButtonStyle from "./Button.style"

function Button({
  bgColor,
  className,
  children,
  disabled,
  form,
  format,
  locked,
  name,
  onClick,
  size,
  textColor,
  type,
  value,
}) {
  return (
    <ButtonStyle
      // Component
      className={className}
      form={form}
      name={name}
      onClick={onClick}
      type={type}
      value={value}
      // Style
      $bgColor={bgColor}
      $disabled={disabled}
      $format={format}
      $locked={locked}
      $size={size}
      $textColor={textColor}
    >
      {children}
    </ButtonStyle>
  )
}

Button.propTypes = {
  /**
   * @description className erwfwef
   */
  className: PropTypes.string,
  /**
   * bgColor blabla
   */
  bgColor: PropTypes.oneOf(["primary", "secondary", "terra", "cream"]),
  children: PropTypes.string,
  disabled: PropTypes.bool,
  form: PropTypes.string,
  format: PropTypes.oneOf(["ghost", "link", "outline", "solid"]),
  locked: PropTypes.bool,
  name: PropTypes.string,
  onClick: PropTypes.func,
  size: PropTypes.oneOf(["small", "medium", "large", "xlarge"]),
  textColor: PropTypes.oneOf(["primary", "secondary", "terra", "cream"]),
  type: PropTypes.oneOf(["button", "reset", "submit"]).isRequired,
  value: PropTypes.string,
}

Button.defaultProps = {
  bgColor: "terra",
  format: "link",
  onClick: () => {},
  size: "small",
  textColor: "cream",
  type: "button",
}

export default Button

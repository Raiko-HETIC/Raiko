import React from "react"
import { useCallback } from "react"

import useTheme from "hooks/useTheme"

const Header = () => {
  const { theme, setTheme } = useTheme()

  const handleToggleThemeClick = useCallback(
    (e) => {
      e.preventDefault()
      setTheme(theme === "dark" ? "light" : "dark")
    },
    [setTheme, theme]
  )

  return (
    <div>
      <Button onClick={handleToggleThemeClick}>Toggle theme color</Button>
    </div>
  )
}

export default Header

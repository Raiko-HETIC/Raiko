import React, { useMemo, useEffect, useState } from "react"
import PropTypes from "prop-types"
import { ThemeProvider as Provider } from "styled-components"

import ThemeContext from "contexts/ThemeContext"

import ResetStyle from "style/global/reset"
import FontStyles from "style/global/fonts"
import GlobalStyle from "style/global/global"
import { dark, light } from "style/themes"

function ThemeProvider({ children }) {
  const [theme, setTheme] = useState("light")

  const values = {
    theme,
    setTheme,
  }

  const themeObject = useMemo(() => {
    switch (theme) {
      case "dark": {
        return dark
      }
      default: {
        return light
      }
    }
  }, [theme])

  useEffect(() => {
    window
      .matchMedia("(prefers-color-scheme: dark)")
      .addEventListener("change", (e) => {
        if (e.matches) {
          setTheme("dark")
        }
      })
    window
      .matchMedia("(prefers-color-scheme: light)")
      .addEventListener("change", (e) => {
        if (e.matches) {
          setTheme("light")
        }
      })
  }, [])

  return (
    <Provider theme={themeObject}>
      <ThemeContext.Provider value={values}>
        <ResetStyle />
        <FontStyles />
        <GlobalStyle />
        <div className={`theme theme--${theme}`} theme={theme}>
          {children}
        </div>
      </ThemeContext.Provider>
    </Provider>
  )
}

ThemeProvider.propTypes = {
  children: PropTypes.node.isRequired,
  chosenTheme: PropTypes.string,
}

ThemeProvider.defaultProps = {
  chosenTheme: null,
}

export default ThemeProvider

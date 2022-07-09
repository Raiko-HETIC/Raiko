import styled, { css } from "styled-components";

const TextStyle = styled.p`
  color: ${({ theme, $color }) => theme.colors[$color]};
  ${({ $size, $textAlign }) => {
    let fontSize;
    switch ($size) {
      case "xsmall":
        fontSize = 16;
        break;
      case "small":
        fontSize = 20;
        break;
      case "large":
        fontSize = 36;
        break;
      case "xlarge":
        fontSize = 48;
        break;
      default:
        fontSize = 16;
        break;
    }
    return css`
      font-size: ${fontSize}px;
      text-align: ${$textAlign};
    `;
  }}
`;

export default TextStyle;

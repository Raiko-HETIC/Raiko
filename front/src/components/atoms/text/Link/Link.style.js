import styled from "styled-components";
import { Link as RouterLink } from "react-router-dom";
import { themeColorLight } from "style/vars/colors";

/**
 * @description Modification of React Router Link style
 */

const Link = styled(RouterLink)`
  color: ${themeColorLight.cream};
  text-decoration: none;
`;

export default Link;

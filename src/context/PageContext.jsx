import { createContext, useContext } from 'react';

export const PageContext = createContext({
  waMessage: 'Hi, I would like to discuss digital marketing services.',
});

export function usePage() {
  return useContext(PageContext);
}

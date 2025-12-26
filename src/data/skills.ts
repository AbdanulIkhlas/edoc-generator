export interface Skill {
  name: string;
  category: "core" | "framework" | "tool" | "design";
  proficiency: "expert" | "advanced" | "proficient";
  description: string;
  icon?: string;
}

export const skillsContent = {
  heading: "Skills & Focus",
  subheading: "Technologies and tools I work with",
  coreFocusLabel: "Core Focus",
  coreFocus: "Building performant, accessible, and beautiful web interfaces with modern JavaScript frameworks.",
};

export const skills: Skill[] = [
  {
    name: "React",
    category: "framework",
    proficiency: "expert",
    description: "Component architecture, hooks, state management, performance optimization",
  },
  {
    name: "TypeScript",
    category: "core",
    proficiency: "expert",
    description: "Type-safe development, generics, utility types, strict configurations",
  },
  {
    name: "Next.js",
    category: "framework",
    proficiency: "advanced",
    description: "SSR, SSG, API routes, middleware, app router architecture",
  },
  {
    name: "Tailwind CSS",
    category: "tool",
    proficiency: "expert",
    description: "Utility-first styling, custom design systems, responsive patterns",
  },
  {
    name: "Framer Motion",
    category: "tool",
    proficiency: "advanced",
    description: "Complex animations, gestures, layout animations, scroll-linked effects",
  },
  {
    name: "JavaScript",
    category: "core",
    proficiency: "expert",
    description: "ES6+, async patterns, DOM manipulation, browser APIs",
  },
  {
    name: "CSS/SCSS",
    category: "core",
    proficiency: "expert",
    description: "Grid, Flexbox, animations, custom properties, responsive design",
  },
  {
    name: "Node.js",
    category: "framework",
    proficiency: "proficient",
    description: "REST APIs, Express, serverless functions, build tooling",
  },
  {
    name: "Figma",
    category: "design",
    proficiency: "advanced",
    description: "Component design, prototyping, design systems, dev handoff",
  },
  {
    name: "Git",
    category: "tool",
    proficiency: "expert",
    description: "Version control, branching strategies, code review workflows",
  },
  {
    name: "Testing",
    category: "tool",
    proficiency: "advanced",
    description: "Jest, Testing Library, Cypress, unit and integration testing",
  },
  {
    name: "WebGL/Three.js",
    category: "tool",
    proficiency: "proficient",
    description: "3D graphics, shaders, creative coding, interactive experiences",
  },
];

export const skillCategories = [
  { key: "core", label: "Core Technologies" },
  { key: "framework", label: "Frameworks & Libraries" },
  { key: "tool", label: "Tools & Workflow" },
  { key: "design", label: "Design" },
];

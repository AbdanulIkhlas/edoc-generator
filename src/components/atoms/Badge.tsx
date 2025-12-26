import { motion } from "framer-motion";

interface BadgeProps {
  children: React.ReactNode;
  variant?: "default" | "primary" | "outline";
}

const Badge = ({ children, variant = "default" }: BadgeProps) => {
  const variants = {
    default: "bg-secondary text-secondary-foreground",
    primary: "bg-primary text-primary-foreground",
    outline: "border border-border text-muted-foreground bg-transparent",
  };

  return (
    <motion.span
      className={`inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${variants[variant]}`}
      whileHover={{ scale: 1.05 }}
    >
      {children}
    </motion.span>
  );
};

export default Badge;
